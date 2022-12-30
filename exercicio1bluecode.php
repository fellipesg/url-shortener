<?php

/**
* Given a list of products such as 'name', 'unit price', 'quantity',
*
* - write a script to display the products sorted by prices, the most expensive first
* - if 2 products have the same price, sort by quantities, the highest first
* - bonus: display in your sorted list of products the total price per product (quantity * unit
price)
*/

$products = [
['Milk', '1.25', 2],
['Eggs', '4.99', 1],
['Granulated sugar', '1.25', 1],
['Broccoli', '2.34', 3],
['Chocolate bar', '1.25', 5],
['Organic All-purpose flour', '4.99', 2]
];

function compare($a, $b) 
{
	if($a[1] != $b[1]) {
		return $a[1] < $b[1] ? 1 : -1;
	}
	
	return $a[2] < $b[2] ? 1 : -1;
}

usort($products, 'compare');


foreach($products as $product)
{
	$totalPrice = $product[1] * $product[2];
		
	echo "$product[0] - Unit Price: $product[1] - Quantity: $product[2] - Total price: $totalPrice";
	echo '<br>';
}


/*Resposta
Organic All-purpose flour - Unit Price: 4.99 - Quantity: 2 - Total price: 9.98
Eggs - Unit Price: 4.99 - Quantity: 1 - Total price: 4.99
Broccoli - Unit Price: 2.34 - Quantity: 3 - Total price: 7.02
Chocolate bar - Unit Price: 1.25 - Quantity: 5 - Total price: 6.25
Milk - Unit Price: 1.25 - Quantity: 2 - Total price: 2.5
Granulated sugar - Unit Price: 1.25 - Quantity: 1 - Total price: 1.25*/

