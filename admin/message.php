<?php
    include "config.php";
    include "toper.php";
?>


<div class="container">
    <?php 
        $sql="SELECT * FROM contact_us ORDER BY id DESC";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)>0){
    ?>
    <div class="order_sec">
        <h3>Message Table</h3>
        <div class="message_table">
            <table class="order_table">
                <thead class="main_head">
                    <tr>
                        <th>Order No.</th>
                        <th >Personal Info.</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Message Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                while($row=mysqli_fetch_assoc($res)){
                    
                ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td class="sec_child"><b>Name:</b> <?php echo $row['name']; ?> <br><b>Email:</b><?php echo $row['email']; ?> <br><b>Mobile: </b><?php echo $row['mobile']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td><?php echo $row['added_on']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<?php include "footer.php"; ?>