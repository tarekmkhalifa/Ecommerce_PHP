<?php
// Header==>
require_once("layouts/header.php");
// middllware ==> only logged in useres can enter
require_once("app/middllwares/auth.php");
// NavBar ==>
require_once("layouts/nav.php");
// Profile Process ==>
require_once("app/process/profile.php");

?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>My Profile</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Profile</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse 
                            <?php
                            // to show collaps when be error
                            if (isset($updateInfoErrors) | isset($keyValidation) | isset($fieldValidation)) {
                                echo "show";
                            }
                            ?>
                            ">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>My Account Information</h4>
                                            <h5>Your Personal Details</h5>
                                        </div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-4 offset-4">
                                                    <img src="assets/img//users/<?= $user->image ?>" alt="" class="w-100 rounded-circle">
                                                    <input type="file" name="image">
                                                </div>
                                                <div class='col-12 mt-4 mb-4'>
                                                    <div class="text-center">
                                                        <?php

                                                        if (isset($errors) && $errors) {
                                                            foreach ($errors as $key => $error) {
                                                                echo $error;
                                                            }
                                                        }

                                                        if (isset($keyValidation) && $keyValidation) {
                                                            foreach ($keyValidation as $key => $error) {
                                                                echo $error;
                                                            }
                                                        }
                                                        if (isset($fieldValidation) && $fieldValidation) {
                                                            foreach ($fieldValidation as $key => $error) {
                                                                echo $error;
                                                            }
                                                        }

                                                        if (isset($updateInfoErrors) && $updateInfoErrors) {
                                                            foreach ($updateInfoErrors as $key => $error) {
                                                                echo $error;
                                                            }
                                                        }

                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Name</label>
                                                        <input type="text" name="name" value="<?= $user->name ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" value="<?= $user->phone ?>">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Gender</label>
                                                        <select class="form-control" name="gender">
                                                            <option value="m" <?php if ($user->gender == 'm') {
                                                                                    echo 'selected';
                                                                                } ?>>Male</option>
                                                            <option value="f" <?php if ($user->gender == 'f') {
                                                                                    echo 'selected';
                                                                                } ?>>Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update-info">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-4">Change your Email </a></h5>
                            </div>
                            <div id="my-account-4" class="panel-collapse collapse 
                            
                            <?php
                            if (isset($updateEmailErrors) | isset($emailValidation)) {
                                echo "show";
                            }
                            ?>                 
                            ">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Email</h4>
                                        </div>
                                        <div class='text-center'>

                                            <?php
                                            if (isset($updateEmailErrors) && $updateEmailErrors) {
                                                foreach ($updateEmailErrors as $key => $error) {
                                                    echo $error;
                                                }
                                            }
                                            if (isset($emailValidation) && $emailValidation) {
                                                foreach ($emailValidation as $key => $error) {
                                                    echo $error;
                                                }
                                            }
                                            ?>

                                        </div>


                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Email Address</label>
                                                        <input type="email" name="email" value="<?= $user->email ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">

                                                <div class="billing-btn">
                                                    <button type="submit" name="change-email">Change Email</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse  
                            
                            <?php
                            if (isset($updatePasswordErrors) | isset($passwordKeyValidation) | isset($passwordValidation)) {
                                echo "show";
                            }
                            ?>
                            
                            
                            ">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Password</h4>
                                        </div>
                                        <div class="text-center">

                                            <?php

                                            if (isset($updatePasswordErrors) && $updatePasswordErrors) {
                                                foreach ($updatePasswordErrors as $key => $error) {
                                                    echo $error;
                                                }
                                            }

                                            if (isset($passwordKeyValidation) && $passwordKeyValidation) {
                                                foreach ($passwordKeyValidation as $key => $error) {
                                                    echo $error;
                                                }
                                            }

                                            if (isset($passwordValidation) && $passwordValidation) {
                                                foreach ($passwordValidation as $key => $error) {
                                                    echo $error;
                                                }
                                            }


                                            ?>
                                        </div>

                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Old Password</label>
                                                        <input type="password" name="old-password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="new-password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password Confirm</label>
                                                        <input type="password" name="confirm-password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">

                                                <div class="billing-btn">
                                                    <button type="submit" name="change-password">Change Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>4</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your address book entries </a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse
                            <?php
                            if (
                                isset($addressKeyValidation) |  isset($addressValidation) |
                                isset($addAddressErrors) | isset($deleteAddreessErrros) | isset($addressKeyEdit) |
                                isset($editAddressErrors) | isset($addressEditValidation) 
                            ) {
                                echo "show";
                            }
                            ?>
                            ">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper text-center">
                                        <?php
                                        // to show errors 
                                        if (isset($deleteAddreessErrros) && $deleteAddreessErrros) {
                                            foreach ($deleteAddreessErrros as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        if (isset($editAddressErrors) && $editAddressErrors) {
                                            foreach ($editAddressErrors as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        if (isset($addressKeyEdit) && $addressKeyEdit) {
                                            foreach ($addressKeyEdit as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        if (isset($addressEditValidation) && $addressEditValidation) {
                                            foreach ($addressEditValidation as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="account-info-wrapper">
                                    <h4>Add Address</h4>
                                    <div class="text-right">
                                    <button id="add_address_btn" class="btn btn-success"> Add New Address</button>
                                </div>
                                </div>
                                <?php

                                if (isset($addAddressErrors) && $addAddressErrors) {
                                    foreach ($addAddressErrors as $key => $error) {
                                        echo $error;
                                    }
                                }

                                if (isset($addressKeyValidation) && $addressKeyValidation) {
                                    foreach ($addressKeyValidation as $key => $error) {
                                        echo $error;
                                    }
                                }

                                if (isset($addressValidation) && $addressValidation) {
                                    foreach ($addressValidation as $key => $error) {
                                        echo $error;
                                    }
                                }

                                ?>



                                <div id="add_address">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="Street"> Street </label>
                                                    <input type="text" name="street" id="Street" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="Building"> Building </label>
                                                    <input type="text" name="building" id="Building" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="Floor"> Floor </label>
                                                    <input type="text" name="floor" id="Floor" value="">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="Flat"> Flat </label>
                                                    <input type="text" name="flat" id="Flat" value="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="Region"> Region </label>
                                                    <select type="text" class="form-control" name="region_id" id="Region">
                                                        <?php
                                                        foreach ($cities as $key => $city) {
                                                        ?>
                                                            <optgroup label="<?= $city['name'] ?>">
                                                                <?php
                                                                $allRegions->setCity_id($city['id']);
                                                                $regions = $allRegions->selectRegionsCity();
                                                                if ($regions) {
                                                                    $regions->fetch_all(MYSQLI_ASSOC);
                                                                    foreach ($regions as $key => $region) { ?>
                                                                        <option value="<?= $region['id'] ?>">
                                                                            <?= $region['name'] ?>
                                                                        </option>
                                                                    <?php }
                                                                } else {
                                                                    ?>
                                                                    <option disabled value=""> There is no regions </option>

                                                                <?php } ?>

                                                            </optgroup>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="Notes"> Notes </label>
                                                    <textarea cols="3" rows="3" name="details" id="Notes"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button type="submit" class='btn btn-success' name="add-address">Add Address</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="account-info-wrapper">
                                    <h4>Address Book Entries</h4>
                                </div>

                                <?php
                                foreach ($userAddress as $key => $address) { ?>
                                    <div class='form-address'>
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Street"> Street </label>
                                                        <input type="text" name="street" id="street" value="<?= $address['street'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Building"> Building </label>
                                                        <input type="text" name="building" id="Building" value="<?= $address['building'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Floor"> Floor </label>
                                                        <input type="text" name="floor" id="Floor" value="<?= $address['floor'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Flat"> Flat </label>
                                                        <input type="text" name="flat" id="Flat" value="<?= $address['flat'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Region"> Region </label>
                                                        <select type="text" class="form-control" name="region_id" id="Region">
                                                            <?php
                                                            foreach ($cities as $key => $city) {
                                                            ?>
                                                                <optgroup label="<?= $city['name'] ?>">
                                                                    <?php
                                                                    $allRegions->setCity_id($city['id']);
                                                                    $regions = $allRegions->selectRegionsCity();
                                                                    if ($regions) {
                                                                        $regions->fetch_all(MYSQLI_ASSOC);
                                                                        foreach ($regions as $key => $region) { ?>
                                                                            <option value="<?= $region['id'] ?>" <?php if ($address['region_id'] == $region['id']) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>
                                                                                <?= $region['name'] ?>
                                                                            </option>
                                                                        <?php }
                                                                    } else {
                                                                        ?>
                                                                        <option disabled value=""> There is no regions </option>

                                                                    <?php } ?>

                                                                </optgroup>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Details"> Notes </label>
                                                        <textarea cols="3" rows="3" name="details" id="Details"><?= $address['details'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <button class='btn btn-secondary' name="edit-address" value="<?= $address['id'] ?>">Edit</button>
                                                        <button class='btn btn-danger' name="delete-address" value="<?= $address['id'] ?>">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
<!-- my account end -->
<?php include_once "layouts/footer.php"; ?>