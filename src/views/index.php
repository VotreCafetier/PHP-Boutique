<?php 
$PageTitle = 'Home';
require "../template/header.php";
require "../template/nav.php";

// fetch brand data
$brands = $product->GetBrands();

// splice the array at 6 brand
\array_splice($brands, 6);

include_once "../template/alert.php";
?>

<section class="container" id="index_page">
    <h1>Promotions</h1>
    <!-- Promo container --> 
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="../../public/img/promo/Promo_2for1.png" alt="Two for one promo 2022">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="../../public/img/promo/Promo_200ormore.png" alt="200 or more get a free t-shirt 2022">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Shop by Brand -->
    <h1>Shop brands</h1>
    <div class="grid-3" id="shop_brand">
        <?php foreach($brands as $k=>$v): ?>
            <a href="Shop?brand=<?php echo $v['BrandName'] ?>">
                <h4><?php echo $v['BrandName'] ?></h4>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Random shoes -->
    <h1>Here is a suggestion of shoes</h1>
    <div class="grid">
        <div>
            <!-- Images -->
            <!-- Name -->
            <!-- Price -->
        </div>
    </div>
</section>

<?php require_once('../template/footer.php'); ?>


<script>
    // fetch elem each 30s
    async function fetchProducts(){
        const response = await fetch('_getproducts.php')
        .then(r => r.json())
        .then(data => console.log(data));
        return response;
    }
    fetchProducts();
    setInterval(fetchProducts, 60000);
</script>