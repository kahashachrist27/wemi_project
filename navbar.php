<input type="hidden" id="CURRENCY" value="<?= CURRENCY?>"/>
<header class="site-navbar p-0 " role="banner">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-3">
        <h6 class="site-logo"><a href="index.php" class="h2"><img src="images/icons/logo.png" style="height: 50px; width: 100px;"><!-- <?= WEB_SITE_NAME ?> --><span class="text-primary"></span> </a></h6>
      </div>
      <div class="col-9">
        <nav class="site-navigation position-relative text-right text-md-right" role="navigation">
          <div class="d-block d-lg-none ml-md-0 mr-auto"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
          </div>
          <ul class="site-menu js-clone-nav d-none d-lg-block">
            <li class="">
              <a href="index.php">Acceuil</a>
            </li>
            
            <li><a href="#" data-toggle="modal" data-target="#modalCart">Panier<span class="badge"></span></a>
            </li>
            <li><a href="#" data-toggle="modal" data-target="#modal_rechercher">Rechercher</a>
            <li><a href="contact.php"><span class="glyphicon glyphicon-modal-window"></span>Contacts</a></li>
            <li><a href="slider.php"><span class="glyphicon fa fa-eye"></span>+</a></li>
            </li>
            <li class="has-children">
              <?php if (isset($_SESSION["uid"])) { ?>
                <a href="#"><span class="fa fa-user"></span><?php echo "Hi,".$_SESSION["name"]; ?></a>
                <ul class="dropdown arrow-top">
                  <li><a href="cart.php"><span class="fa fa-cart">Panier</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Changer mot de passe</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                  </ul>
                <?php }else{ ?>
                  <li class="has-children">
                    <a href="#"><span class="fa fa-user"></span> Connexion</a>
                    <ul class="dropdown arrow-top">
                      <li><a href="login_form.php"><span class="fa fa-user">Connexion</a></li>
                      <li class="divider"></li>
                      <li><a href="customer_registration.php?register=1">Créer votre compte</a></li>
                    </ul>
                  </li>
                <?php } ?>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- <hr> -->
  </div>
</header>

<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="display-6" id="exampleModalLabel">Mon panier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table>
          <thead>
            <tr>
              <th>Sl.No</th>
              <th>Image du Produit</th>
              <th>Nom du produit</th>
              <th>Prix en <?php echo CURRENCY; ?></th>
            </tr>
          </thead>
          <tbody id="cart_product">

          </tbody>
        </table>

      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="modal_rechercher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="display-6" id="exampleModalLabel">Mon panier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form class="navbar-form navbar-left" method="GET" action="search.php">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Tapez votre recherche..." id="search" name="s">
          </div>
          <button type="submit" class="btn btn-primary" id="search_btn">
            <span class="fa fa-search">Rechercher</span>
          </button>
        </form>
      </div>

    </div>
  </div>
</div>


