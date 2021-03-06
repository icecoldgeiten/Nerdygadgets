<?php
include __DIR__ . "/header.php";
include __DIR__ . "/cartfunctions.php";
include __DIR__ . "/formatfunctions.php";
include __DIR__ . "/ProductAvailabilityFunctions.php";

$Query = " 
           SELECT SI.StockItemID, 
            (RecommendedRetailPrice*(1+(TaxRate/100))) AS SellPrice, 
            StockItemName,
            QuantityOnHand,
            SearchDetails,
            SI.ValidTo,
            (CASE WHEN (RecommendedRetailPrice*(1+(TaxRate/100))) > 50 THEN 0 ELSE 6.95 END) AS SendCosts, MarketingComments, CustomFields, SI.Video,
            (SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = SI.StockItemID LIMIT 1) as BackupImagePath   
            FROM stockitems SI 
            JOIN stockitemholdings SIH USING(stockitemid)
            JOIN stockitemstockgroups ON SI.StockItemID = stockitemstockgroups.StockItemID
            JOIN stockgroups USING(StockGroupID)
            WHERE SI.stockitemid = ?
            GROUP BY StockItemID";

$ShowStockLevel = 1000;
$Statement = mysqli_prepare($Connection, $Query);
mysqli_stmt_bind_param($Statement, "i", $_GET['id']);
mysqli_stmt_execute($Statement);
$ReturnableResult = mysqli_stmt_get_result($Statement);
if ($ReturnableResult && mysqli_num_rows($ReturnableResult) == 1) {
    $Result = mysqli_fetch_all($ReturnableResult, MYSQLI_ASSOC)[0];
} else {
    $Result = null;
}

if (isset($_GET["id"])) {
    $stockItemID = $_GET["id"];
} else {
    $stockItemID = 0;
}


//Get Images
$Query = "
                SELECT ImagePath
                FROM stockitemimages
                WHERE StockItemID = ?";

$Statement = mysqli_prepare($Connection, $Query);
mysqli_stmt_bind_param($Statement, "i", $_GET['id']);
mysqli_stmt_execute($Statement);
$R = mysqli_stmt_get_result($Statement);
$R = mysqli_fetch_all($R, MYSQLI_ASSOC);

if ($R) {
    $Images = $R;
}

//Get Temperature
$Query = "
                SELECT Temperature
                FROM coldroomtemperatures 
                WHERE ColdRoomSensorNumber = 1
                ORDER BY ValidFrom desc";

$Statement = mysqli_prepare($Connection, $Query);
mysqli_stmt_execute($Statement);
$T = mysqli_stmt_get_result($Statement);
$T = mysqli_fetch_all($T, MYSQLI_ASSOC);

?>
<?php
if ($Result != null) {
    ?>
    <?php
    if (isset($Result['Video'])) {
        ?>
        <div id="VideoFrame">
            <?php print $Result['Video']; ?>
        </div>
    <?php }
    ?>
    <div class="row">
        <div class="col-md-4 col-xs-12 mt-3">
            <?php
            if (isset($Images)) {
                // print Single
                if (count($Images) == 1) {
                    ?>
                    <div id="ImageFrame"
                         style="background-image: url('Public/StockItemIMG/<?php print $Images[0]['ImagePath']; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                    <?php
                } else if (count($Images) >= 2) { ?>
                    <div id="ImageFrame">
                        <div id="ImageCarousel" class="carousel slide" data-interval="false">
                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <?php for ($i = 0; $i < count($Images); $i++) {
                                    ?>
                                    <li data-target="#ImageCarousel"
                                        data-slide-to="<?php print $i ?>" <?php print (($i == 0) ? 'class="active"' : ''); ?>></li>
                                    <?php
                                } ?>
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                <?php for ($i = 0; $i < count($Images); $i++) {
                                    ?>
                                    <div class="carousel-item <?php print ($i == 0) ? 'active' : ''; ?>">
                                        <img src="Public/StockItemIMG/<?php print $Images[$i]['ImagePath'] ?>">
                                    </div>
                                <?php } ?>
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#ImageCarousel" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#ImageCarousel" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div id="ImageFrame"
                     style="background-image: url('Public/StockGroupIMG/<?php print $Result['BackupImagePath']; ?>'); background-size: cover;"></div>
                <?php
            }
            ?>
        </div>
        <div class="col-md-8 col-xs-12 mt-xs-5">
            <h1 class="StockItemID">Artikelnummer: <?php print $Result["StockItemID"]; ?></h1>
            <?php
            $days = ProductAvailableDays($Result['ValidTo']);
            if (($days < 7 && $days != 0) && $Result['QuantityOnHand'] > 0) { ?>
                <span class="text-danger m-0 p-0">Snel bestellen: dit product is nog maar <?= '<u>' . $days . '</u>' ?> <?= $days == 1 ? 'dag' : 'dagen' ?> beschikbaar!</span>
            <?php } ?>
            <h2 class="StockItemNameViewSize StockItemName">
                <?php print $Result['StockItemName']; ?>
            </h2>
            <div class="QuantityText"><?php print "Voorraad: " . $Result['QuantityOnHand']; ?></div>
            <div id="StockItemHeaderLeft">
                <div class="CenterPriceLeft">
                    <div class="CenterPriceLeftChild">
                        <p class="StockItemPriceText"><b><?php print sprintf("€ %.2f", $Result['SellPrice']); ?></b></p>
                        <h6> Inclusief BTW </h6>
                        <?php
                        if (ProductAvailableDays($Result['ValidTo']) != 0 && $Result['QuantityOnHand'] > 0) {
                            ?>
                            <form method="post">
                                <input type="number" name="stockItemID" value="<?php print($stockItemID) ?>" hidden>
                                <input type="submit" class="btn btn-outline-success" name="submit"
                                       value="Voeg toe aan winkelmand">
                            </form>
                            <?php
                        } else {
                            ?>
                            <p class="text-danger">Dit product is niet meer beschikbaar</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
    <div class="col-md-6 col-xs-12">
        <div id="StockItemDescription">
            <h3>Artikel beschrijving</h3>
            <p><?php print $Result['SearchDetails']; ?></p>
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div id="StockItemSpecifications">
            <h3>Artikel specificaties</h3>
            <?php
            $CustomFields = json_decode($Result['CustomFields'], true);
            if (is_array($CustomFields)) {
                ?>
                <table class="table-specifications">
                <?php foreach ($CustomFields as $SpecName => $SpecText) {
                    if (empty($SpecText)) unset($SpecName);
                    ?>
                    <tr>
                        <td>
                            <?= !empty($SpecText) ? TransformPascalCase($SpecName) . ': ' : ''; ?>
                        </td>
                        <td>
                            <?php
                            if (is_array($SpecText)) {
                                $last = end($SpecText);
                                foreach ($SpecText as $key => $SubText) {
                                    if ($SubText === $last) {
                                        print $SubText;
                                    } else {
                                        print $SubText . ', ';
                                    }
                                }
                            } else {
                                print '<u>' . $SpecText . '</u>';
                            }
                            ?>
                        </td>
                    </tr>

                <?php } ?>
                <tr>
                    <?php
                    $pos = strpos($Result['StockItemName'], 'hocol');
                    $antipos = strpos($Result['StockItemName'], 'flash drive');
//                    var_dump($T); exit();
                    if (!empty($T)) {
                        if ($pos && !$antipos && $Result['QuantityOnHand'] > 0) {
//                        var_dump($pos, $antipos); exit();
                            print '<td>Current temperature: </td>' . '<td> <u>' . $T[0]['Temperature'] . ' °C' . '</u> </td>';
                        }
                    }
                    ?>
                </tr>
                </table><?php
            } else { ?>
                <p><?php print $Result['CustomFields']; ?></p>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
} else {
    ?><h2 id="ProductNotFound">Het opgevraagde product is niet gevonden.</h2><?php
} ?>
    </div>
<?php
if (isset($_POST['submit'])) {
    AddToCart();
}
?>