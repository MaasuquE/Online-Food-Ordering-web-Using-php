<?php  
    include "config.php";
    include "vendor/autoload.php";
    session_start();
    $css=file_get_contents('assets/css/bootstrap.min.css');
    $css.=file_get_contents('assets/css/style.css');
    $css.=file_get_contents('assets/css/custom.css');
    
    $html ='<div class="table-content table-responsive">
    <table >
        <thead>
            <tr>
                <th>Image</th>
                <th>Dish Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Delivery boy</th>
                <th>Address</th>
                <th>Subtotal</th>
            </tr>
        </thead>';
        $user_id = $_SESSION['user_id'];
        $sql="SELECT * FROM order_master 
        LEFT JOIN order_detail ON order_master.order_details_id=order_detail.order_details_id
        LEFT JOIN dish ON order_master.dish_id = dish.dish_id
        LEFT JOIN delivery_boy ON order_detail.delivery_boy_id=delivery_boy.id
        WHERE order_master.order_sts=1 AND order_master.user_id={$user_id}
        ORDER BY order_master.order_id DESC";
        
        $res=mysqli_query($con,$sql);
        if(mysqli_num_rows($res)>0){
        
        $html .='<tbody>';
        $subtotal = 0;
        while($row=mysqli_fetch_assoc($res)){

        $html .='<tr>
        <td class="product-thumbnail"><a href="#"><img src="admin/upload/'.$row['image'].'" height="60px" width="60px" alt=""></a></td>
        <td class="product-name"><a href="#">'.$row['dish'].'</a></td>
        <td class="product-price-cart"><span class="amount">'.$row['dish_price'].'</span></td>
        <td class="product-price-cart"><span class="amount">'.$row['order_qty'].'</span></td>
        <td class="product-name"><a href="#">'.$row['boy_name'].'</a></td>
        <td class="product"><a href="#">'.$row['address'].'</a></td>
        <td class="product-subtotal">';
            $subtotal = $row['dish_price']*$row['order_qty'];
        $html .=''.$subtotal.'</td>
            </tr>';
            }
        $html .='</tbody>';
                }
        $html .='</table></div>';
    
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($css,1);
    $mpdf->WriteHTML($html,2);
    $file = time().".pdf";
    $mpdf->Output($file,'D');
?>
