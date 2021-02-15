<?php 

$myString = "Product ID,Description,Category,Manufacturer,Std bin ID,Std packing,Units QoH,Units Reserved,Units Remaining,Units On order,Units Available
.831131000351,Source Ginger Bear,,,,,0,0,0,0,0
0000,Joseph Magnus 375ml,,,,,-1,0,-1,0,-1
000000284561,Crooked Can McStaggers 6pk-12oz Cans,Craft Beer ,,,,0,0,0,0,0
000000318310,Stone Saison Duboff 500ml,Craft Beer ,,,,0,0,0,0,0
000004106432,Blackburn Cabernet,Cabernet ,,,,1,0,1,0,1
000004112938,Proulx Paso Robles Petote Sirah,,,,,0,0,0,0,0
000006,Handroll Cigars,Tobacco,,,,-1,0,-1,0,-1
000008204103,Popov Vodka - 1L,Vodka,,,,0,0,0,0,0
000008253606,Ciroc Mango Vodka - 50ml,Vodka,,,,12,0,12,0,12
000008254306,Captain Morgan Loco Nut - 50ml,Rum ,,,,0,0,0,0,0";
$myArray = explode(',', $myString);
print_r($myArray);
?>