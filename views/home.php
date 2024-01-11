<!doctype html>
<html lang="en">

<?php include 'includes/nav.php'; ?>

<div class="hero overlay inner-page bg-primary py-5">
  <div class="container">
    <div class="row align-items-center justify-content-center text-center pt-5">
      <div class="col-lg-6">
        <h1 class="heading text-white mb-3" data-aos="fade-up">Welcome To Wiki</h1>
      </div>
    </div>
  </div>
</div>

<div class="section search-result-wrap">
  <div class="container">

    <div class="row posts-entry">
      <div class="col-lg-8">

 <?php foreach ($AllWikies as $wiki) : ?>
        <div class="blog-entry d-flex blog-entry-search-item">
         
            <a href="wiki" class="img-link me-4">
              <img src="/wiki/app/routes/<?php echo $wiki['wiki_image']; ?>" alt="Image" class="img-fluid">
            </a>
            <div>
              <span class="date"><?php echo date('M. dS, Y', strtotime($wiki['created_at'])); ?> &bullet; <a href="#"><?php echo $wiki['category_name']; ?></a></span>
              <h2><a href="wiki"><?php echo $wiki['title']; ?></a></h2>
              <p><?php // Add content here if needed 
                  ?></p>
              <p><a href="wiki?wiki_id=<?php echo $wiki['id'] ?>" class="btn btn-sm btn-outline-primary">Read More</a></p>
            </div>
         
        </div>
 <?php endforeach; ?>
      </div>

      <div class="col-lg-4 sidebar">

        <div class="sidebar-box search-form-wrap mb-4">
          <form action="#" class="sidebar-search-form">
            <!-- <span class="bi-search"></span> -->
            <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
          </form>
        </div>
        <!-- END sidebar-box -->

        <!-- END sidebar-box -->

        <div class="sidebar-box">
          <h3 class="heading">Categories</h3>

          <ul class="categories">
            <?php foreach ($mostUsedCategories as $cat) : ?>
              <li><a href="#"><?php echo $cat['categoryName']; ?></li>
            <?php endforeach; ?>
          </ul>

        </div>
        <!-- END sidebar-box -->

        <div class="sidebar-box">
          <h3 class="heading">Tags</h3>

          <ul class="tags">
            <?php foreach ($mostUsedtags as $tag) : ?>
              <li><a href="#"><?php echo $tag['TagName']; ?></a></li>
            <?php endforeach; ?>
          </ul>

        </div>

      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>

</html>