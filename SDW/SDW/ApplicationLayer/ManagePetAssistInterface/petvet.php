<?php
session_start();
    // $_SESSION = [];
require_once '../../BusinessServiceLayer/controller/petController.php';
require_once '../../BusinessServiceLayer/controller/cartController.php';
$petvet = new petvetController();
$cart = new cartController();
$data = $petvet->viewAll(); 
$view_variable = 'a string here';

  if (!isset($_SESSION['username'])) {
    $message = "You must log in first";
        header('refresh:5; url=login.php');
        echo "<script type='text/javascript'>alert('$message');
        window.location = '../view';</script>";
  }

  if (isset($_POST ['delete'])) {
    $petvet->delete();
  }

  if(isset($_POST['buy'])){
    $cart->add();
    // console_log($view_variable);


    // $sql = "insert into cart(petvetgroom_name, petvetgroom_quantity, petvetgroom_price, petvetgroom_image) select petvetgroom_name, petvetgroom_quantity, petvetgroom_price from petvetgroom where petvetgroom_id = 6";
    //     // $args = [':name'=>$this->name, ':quantity'=>$this->quantity, ':price'=>$this->price];
    //     DB::run($sql,$args);
}

?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<?php include"../../includes/head.php";?>

<body>


  <div class="wrapper" id="wrapper">
    <?php 
    include "../../includes/header.php";
    ?>
  </div>


  <section class="type__category__area bg--white section-padding">
  <div style="background-image: url('../../images/h2.jpg');">
    <h1 class="bradcaump-title"  style="font-weight:bold; color:#000000; font-size:45px; ">PET ASSIST</h1>
  <nav class="bradcaump-inner">
                <a class="breadcrumb-item"  href="../../ApplicationLayer/ManagePetAssistInterface/petassistHome4.php" style="font-weight:bold; color:#000000; font-size:15px;">   PET ASSIST SERVICE</a>
        <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
        <span class="breadcrumb-item active" style="font-weight:bold; color:#000000; font-size:15px; ">PET VETERINARY LIST</span>
  </nav>
  <div class="wrapper wrapper--w790">
    <div class="card card-5">
      <div class="card-heading">
        <h2 class="title">Pet Veterinary List</h2>
      </div>
      <div class="card-body">
  <center>
    <!-- <div class="content_resize2"> -->
      <!-- <center> -->
      <table>
            <thead>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Action</th>
            </thead>
            <?php
            $i = 1;
            foreach($data as $row){
              $image =  $row['petvet_image'];
              $isrc = "../../images/";

               echo "<tr>"
                . "<td>".$row['petvet_name']."</td>"
                . "<td><img src=\"" .$isrc. $row['petvet_image'] . "\" height=\"130\" width=\"150\"> </td>"
                ."<td>RM".$row['petvet_price']."</td>";                         
                       // . "<td>".$row['petvetgroom_price']."</td>";
               ?>
            <td><form action="" method="POST">
              <?php
              if ($_SESSION['usergroup'] == 1) {
                  ?>
              <button class="btn btn--radius-2 btn--red" input type="button" name="view" value="View" onclick="location.href='../../ApplicationLayer/ManagePetAssistInterface/viewpetvet.php?petvet_id=<?=$row['petvet_id']?>'">View</button>
               <br></br>
              <input type="hidden" name="name" value="<?=$row['petvet_name']?>">
              <input type="hidden" name="price" value="<?=$row['petvet_price']?>">
              <input type="hidden" name="image" value="<?=$row['petvet_image']?>">
              <input type="hidden" name="quantity" value="1">
              <button class="btn btn--radius-2 btn--red" type="submit" name="buy" value="BUY">Buy</button>
              <?php
            } elseif ($_SESSION['usergroup'] == 2){ ?>
              <button class="btn btn--radius-2 btn--red" input type="button" name="view" value="View" onclick="location.href='../../ApplicationLayer/ManagePetAssistInterface/viewpetvet.php?petvet_id=<?=$row['petvet_id']?>'">View</button>
              <br></br>
              <button class="btn btn--radius-2 btn--red"input type="button" name = "edit" value="Edit" onclick="location.href='../../ApplicationLayer/ManagePetAssistInterface/editpetvet.php?petvet_id=<?=$row['petvet_id']?>'">Edit</button>
              <br></br>
              <input type="hidden" name="petvet_id" value="<?=$row['petvet_id']?>"><button class="btn btn--radius-2 btn--red"input type="submit" name="delete" value="Delete">Delete</button>
               <br></br>
              <?php
            }?>


                </form></td>
              <?php
              $i++;
             echo "</tr>";
            }
            ?>
        </table>
      </center>
      </div>
    </center>
</section>


<?php
include "../../includes/footer.php";
?>


</div><!-- //Main wrapper -->
<!-- JS Files -->
<script src="js/vendor/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/active.js"></script>


</body>
</html>

