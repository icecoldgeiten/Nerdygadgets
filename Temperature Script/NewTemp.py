import sys
import getopt
import argparse
import sense_hat
import time
import mysql.connector as mariadb
from mysql.connector import errorcode

sh = sense_hat.SenseHat()
delay = 3



# parse arguments
verbose = True
interval = 10  # second


dbconfig = {
    'user': 'Temperatuur',
    'password': '289n!GI0vhnuy*FuvUL',
    'host': '192.168.1.54',
    'database': 'nerdygadgets',
    'raise_on_warnings': True,
}


try:
    while True:
        #-------------------------------
        sensor_name = 'Temperatuur'
        temp = sh.get_temperature()
        temp = temp -37
        temp = '%.2f' % temp
        #-------------------------------
        print (temp)
        
        # instantiate a database connection
        try:
            mariadb_connection = mariadb.connect(**dbconfig)
            if verbose:
                print("Database connected")
                    
        except mariadb.Error as err:
            if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
                print("Something is wrong with your user name or password")
            elif err.errno == errorcode.ER_BAD_DB_ERROR:
                print("Database does not exist")
            else:
                print("Error: {}".format(err))
            sys.exit(2)
            
        # create the database cursor for executing SQL queries
        cursor = mariadb_connection.cursor(buffered=True)
        
        # get the sensor_id for temperature sensor
        sensor_id = cursor.fetchone()
        # verbose
        if verbose:
            print("Temperature: %s C" % temp)

        # store measurement in database
        try:
            insert_stmt = (
                "INSERT INTO coldroomtemperatures (ColdRoomSensorNumber, RecordedWhen, Temperature, ValidFrom, ValidTo)"
                "VALUES (%s, CURRENT_TIMESTAMP, %s, CURRENT_TIMESTAMP, %s)"
            )
            data = (1, temp, '9999-12-31 23:59:59')

            cursor.execute(insert_stmt, data)


        except mariadb.Error as err:
            print("Error: {}".format(err))

        else:
            # commit measurements
            mariadb_connection.commit()

            if verbose:
                print("Temperature committed")


            # close db connection
            cursor.close()
            mariadb_connection.close()
            time.sleep(interval)

        time.sleep(delay)



except KeyboardInterrupt:
    pass