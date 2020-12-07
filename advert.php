<?php


include "connect.php";

ob_start();
include "cart.php";
ob_end_clean();

$totalprice = $totalcart + 0 ;
$difference = SendDifference($totalprice);
$MaxStockID = MaxStockItem();

if ($totalprice >= 0 && $totalprice <= 50){
    $difference = 50-$totalprice;
    $Query = "  SELECT  SI.StockItemID, (RecommendedRetailPrice*(1+(TaxRate/100))) AS SellPrice, StockItemName, SearchDetails, MarketingComments,
                (SELECT ImagePath FROM stockitemimages WHERE StockItemID = SI.StockItemID LIMIT 1) as ImagePath,
                (SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = SI.StockItemID LIMIT 1) as BackupImagePath
                FROM stockitems SI
                WHERE RecommendedRetailPrice*(1+(TaxRate/100)) BETWEEN ?+2 AND ?+7 ";
    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 'ii', $difference, $difference);
    mysqli_stmt_execute($statement);
    $R = mysqli_stmt_get_result($statement);
    $R = mysqli_fetch_all($R, MYSQLI_ASSOC);
    print('Met dit product krijgt u gratis verzending!');
} else {
    $Query = "  SELECT  SI.StockItemID, (RecommendedRetailPrice*(1+(TaxRate/100))) AS SellPrice, StockItemName, SearchDetails, MarketingComments,
                (SELECT ImagePath FROM stockitemimages WHERE StockItemID = SI.StockItemID LIMIT 1) as ImagePath,
                (SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = SI.StockItemID LIMIT 1) as BackupImagePath
                FROM stockitems SI
                WHERE SI.StockItemID = ? ";
    $Getal = rand(1, $MaxStockID);
    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 'i', $Getal);
    mysqli_stmt_execute($statement);
    $R = mysqli_stmt_get_result($statement);
    $R = mysqli_fetch_all($R, MYSQLI_ASSOC);
    print('Dit product raden wij u aan!');
}

$AD = $R[0];
if ($R != null) {?>
    <a class="ListItem" href='view.php?id=<?php print $AD['StockItemID']; ?>'>
        <div id="AdvertisementFrame">
            <?php
            if (isset($AD['ImagePath'])) { ?>
                <div class="AdvImgFrame"
                     style="background-image: url('<?php print "Public/StockItemIMG/" . $AD['ImagePath']; ?>'); background-size: 230px; background-repeat: no-repeat; background-position: center;"></div>
            <?php } else if (isset($AD['BackupImagePath'])) { ?>
                <div class="AdvImgFrame"
                     style="background-image: url('<?php print "Public/StockGroupIMG/" . $AD['BackupImagePath'] ?>'); background-size: cover; margin-bottom: 5px;"></div>
            <?php } ?>

            <div id="StockItemFrameRight">
                <div class="CenterPriceLeftChild">
                    <h1 class="StockItemPriceText"><?php print sprintf("€ %0.2f", $AD["SellPrice"]); ?></h1>
                    <h6>Inclusief BTW </h6>
                </div>
            </div>
            <h1 class="StockItemID">Artikelnummer: <?php print $AD["StockItemID"]; ?></h1>
            <p class="StockItemName"><?php print $AD["StockItemName"]; ?></p>
            <p class="StockItemComments"><?php print $AD["MarketingComments"]; ?></p>
        </div>
    </a> <?php
} else {
}
?>

