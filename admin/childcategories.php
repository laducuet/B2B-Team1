<?php
$pageTitle = "childcategories";
include 'init.php';

  if(!isset($_SESSION['typeOfUser']))
    header("Location: ../signin.php");
if (isset($_SESSION['typeOfUser']) && $_SESSION['typeOfUser'] != "admin") {
  header("Location: ../signin.php");
}

  //check the wanted page [Manage | Edit | Add | Delete] before going there
  $do = isset($_GET['do'])? $_GET['do'] : 'Manage';

  if($do == 'Manage') { //manage page to show all the childcategories
    $childcategories = Getchildcategories($db);
?>
<div class="container category">
  <h1 class="text-center">Manage childcategories</h1>
  <div class="table-responsive">
    <table class="table table-bordered text-center">
      <thead class="thead-dark">
        <tr>
          <th scope="col" class="table-dark">childcategory Name</th>
          <th scope="col" class="table-dark">category Name</th>
          <th scope="col" class="table-dark">childcategory Description</th>
          <th scope="col" class="table-dark">Control</th>
        </tr>
      </thead>
      <tbody>
        <?php
            foreach($childcategories as $childcat) {
              echo '<tr>';
              echo '<th scope="row">' . $childcat['childcategoryName'] . '</th>';
              echo '<th scope="row">' . $childcat['categoryName'] . '</th>';
              echo '<td>' . $childcat['childcategoryDescription'] . '</td>';
              echo '<td>
                      <a href="?do=Edit&childcategoryId=' . $childcat['childcategoryId'] . '" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                      <a href="?do=Delete&childcategoryId=' . $childcat['childcategoryId'] . '" class="btn btn-danger"><i class="fas fa-user-minus"></i> Delete</a>
                    </td>';
              echo '</tr>';
            }
            ?>
      </tbody>
    </table>
  </div>
  <a href="?do=Add" class="btn btn-primary add-btn"><i class="fa fa-plus"></i> Add New Childcategory</a>
</div>

<?php
  } elseif ($do == 'Add') {
    $childcatName = $childcatDes = '';
    $childcatNameErr = $childcatDesErr = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $childcatName = $_POST['name'];
      $childcatDes = $_POST['description'];
      $catId = $_POST['category'];

      $childcatName = input_data($childcatName);
      $childcatDes = input_data($childcatDes);
      $catId = input_data($catId);

      $childcatNameErr = sizeCatName($catName);
      $childcatDesErr = sizeCatDes($catDes);

      if ($childcatNameErr == "" && $childcatDesErr == "") {
        AddNewChildCategory($childcatName, $childcatDes, $catId, $db);
        header("Location: childcategories.php");
      }
    }
?>
<div class="CategoriesForms container mb-5">
  <h1 class="text-center">Add New childcategory</h1>
  <form class="col-lg-8 m-auto" action="?do=Add" method="POST">
    <!-- Name -->
    <div class="input-group mb-2">
      <span class="input-group-text" id="basic-addon1"><i class="fas fa-signature"></i></span>
      <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name"
        aria-describedby="basic-addon1" value="<?php echo $childcatName; ?>" required>
    </div>
    <span class="error"><?php echo $childcatNameErr; ?></span>

    <h1></h1>
    <div class="input-group  mb-4">
        <select required value="<?php if (isset($_SESSION["categoryId"])) {
            echo $_SESSION["categoryId"];
            unset($_SESSION["categoryId'"]);
        } ?>" class="form-select " id="inputGroupSelect02" name="category" required>
            <option selected> Choose Categories...</option>
            <?php $row = getCategories($db);
            foreach ($row as $cat):
                echo '<option value="' . $cat['categoryId'] . '">' . $cat['categoryName'] . '</option>'; ?>
            <?php endforeach ?>
        </select>
        <label class="input-group-text bg-success text-light"
               for="inputGroupSelect02">Options</label>
    </div>

    <!-- Description -->
    <div class="mb-3">
      <label for="des" class="form-label">Description</label>
      <textarea class="form-control" id="des" rows="3" name="description"><?php echo $childcatDes; ?></textarea>
    </div>
    <span class="error"><?php echo $childcatDesErr; ?></span>
    <button type="submit" class="btn btn-primary form-btn">Add</button>
  </form>
</div>

<?php
  } elseif ($do == 'Edit') {
    $childcatId = isset($_GET['childcategoryId']) && is_numeric($_GET['childcategoryId']) ? intval($_GET['childcategoryId']) : 0;
    if (!$childcatId) {
      header("Location: childcategories.php");
    }
    $childcatNameErr = $childcatDesErr = '';
    $childcategory = GetChildcategoryByID($childcatId, $db);
    $childcatName = $childcategory[0]['childcategoryName'];
    $childcatDes = $childcategory[0]['childcategoryDescription'];
    $catId =  $childcategory[0]['categoryId'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $childcatName = $_POST['name'];
      $childcatDes = $_POST['description'];
      $catId = $_POST['category'];

      $childcatName = input_data($childcatName);
      $childcatDes = input_data($childcatDes);
      $catId = input_data($catId);

      $childcatNameErr = sizeCatName($childcatName);
      $childcatDesErr = sizeCatDes($childcatDes);

      if ($catNameErr == "" && $catDesErr == "") {
        UpdateChildCategory($childcatId, $childcatName,$catId, $childcatDes, $db);
        header("Location: childcategories.php");
      }
    }
?>
<div class="CategoriesForms container mb-5">
  <h1 class="text-center">Edit childcategories</h1>
  <form class="col-lg-8 m-auto" action="?do=Edit&childcategoryId=<?php echo $childcatId; ?>" method="POST">
    <!-- Name -->
    <div class="input-group mb-2">
      <span class="input-group-text" id="basic-addon1"><i class="fas fa-signature"></i></span>
      <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Name"
        aria-describedby="basic-addon1" value="<?php echo $childcatName; ?>" required>
    </div>
    <span class="error"><?php echo $childcatNameErr; ?></span>

    <h1></h1>
    <div class="input-group  mb-4">
        <select required value="<?php if (isset($_SESSION["categoryId"])) {
            echo $_SESSION["categoryId"];
            unset($_SESSION["categoryId'"]);
        } ?>" class="form-select " id="inputGroupSelect02" name="category" required>
            <option selected> Choose Categories...</option>
            <?php $row = getCategories($db);
            foreach ($row as $cat):
                echo '<option value="' . $cat['categoryId'] . '">' . $cat['categoryName'] . '</option>'; ?>
            <?php endforeach ?>
        </select>
        <label class="input-group-text bg-success text-light"
               for="inputGroupSelect02">Options</label>
    </div>

    <!-- Description -->
    <div class="mb-3">
      <label for="des" class="form-label">Description</label>
      <textarea class="form-control" id="des" rows="3" name="description"><?php echo $childcatDes; ?></textarea>
    </div>
    <span class="error"><?php echo $childcatDesErr; ?></span>
    <button type="submit" class="btn btn-primary form-btn">Edit</button>
  </form>
</div>
<?php

  } elseif ($do == 'Delete') {
    $childcatId = isset($_GET['childcategoryId']) && is_numeric($_GET['childcategoryId']) ? intval($_GET['childcategoryId']) : 0;
    if (!$childcatId) {
      header("Location: childcategories.php");
    }else {
      $childcategory = GetChildCategoryByID($childcatId, $db);
      if(isset($_POST['submit'])) {
        DeleteChildCategoryByID($childcatId, $db);
        header("Location: childcategories.php");
      }
    }
?>
<div class="CategoriesForms container mb-5">
  <h1 class="text-center">Delete childcategory</h1>
  <div class="delete-box shadow">
    <h3 class="text-center">Are you Sure You Want To Delete <b><?php echo $childcategory[0]['childcategoryName'] ?></b></h3>
    <form action="?do=Delete&childcategoryId=<?php echo $childcatId; ?>" method="POST" class="text-center">
      <button type="submit" name="submit" class="btn btn-danger">Yes</button>
      <a class="btn btn-success" href="?do=Manage">No</a>
    </form>
  </div>
</div>
<?php
  }else {
    header("Location: index.php");
  }
include $tpl . 'footer.php';
?>