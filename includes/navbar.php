<link href="https://fonts.googleapis.com/css?family=Roboto:400,500|Open+Sans" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>p{ margin-bottom: 0rem; margin-right:1rem;}</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Mobile Shop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item" id="dashboard">
        <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <?php
        if($aon){
        ?>
            <li class="nav-item" id="uinfo">
                <a class="nav-link" href="userinfo.php">View User Info </a>
            </li>
            <li class="nav-item" id="suggestions">
        <a class="nav-link" href="suggestions.php">Suggestions</a>
      </li>

        <?php
        }
        else{?>
            <li class="nav-item" id="cart">
                <a class="nav-link" href="viewcart.php">View Cart</a>
            </li>
            <li class="nav-item" id="suggest">
        <a class="nav-link" href="suggestion.php">Suggest</a>
      </li>

        <?php
            }
        ?>
      <li class="nav-item" id="orders">
        <a class="nav-link" href="vieworders.php">View Orders</a>
      </li>
      
       
      
    </ul>
    <p>Hello, <?php echo ucfirst(explode('@',$cs->getUsername())[0]);?></p>
    <a  href="logout.php">Logout</a>
  </div>
</nav>