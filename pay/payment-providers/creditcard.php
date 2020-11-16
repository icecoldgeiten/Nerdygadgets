<form method='get' action='betaalpagina.php'>
    <label for='creditcard-bank'>Kies een soort creditcard: </label>
    <select id='credit-bank' name='credit-bank'>
        <option value='VISA'>VISA</option>
        <option value='Mastercard'>Mastercard</option>
        <option value='American Express'>American Express</option>
    </select><br>
    Creditcard-nummer:  <input type='text' name='creditcard-nummer' placeholder='XXXX-XXXX-XXXX-XXXX'><br>
    Geldig tot:         <input type='text' name='creditcard-maand' placeholder='MM' size='1'> / <input type='text' name='creditcard-jaar' placeholder='YY' size='1'><br>
    Naam op kaart:      <input type='text' name='creditcard-naam' placeholder='J.J. Janssen'><br>
    CVC-code:           <input type='text' name='creditcard-cvc' placeholder='XXX' size='2'><br>
    <br>
    <input type='submit' value='Bestellen'>
</form>