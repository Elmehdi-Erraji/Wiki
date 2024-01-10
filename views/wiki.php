<!doctype html>
<html lang="en">

<?php include 'includes/nav.php'; ?>
<div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('/wiki/app/routes/<?php echo $wikidata->getImage(); ?>');">
  <div class="container">
    <div class="row same-height justify-content-center">
      <div class="col-md-6">
        <div class="post-entry text-center">
          <h1 class="mb-4"><?php echo $wikidata->getTitle(); ?></h1>
          <div class="post-meta align-items-center text-center">
            <figure class="author-figure mb-0 me-3 d-inline-block"><img src="/wiki/app/routes/<?php echo $Author->getImage(); ?>" alt="Image" class="img-fluid"></figure>
            <span class="d-inline-block mt-1">By <?php echo $Author->getUsername(); ?></span>
            <span>&nbsp;-&nbsp; <?php echo date('M. dS, Y', strtotime($wikidata->getCreatedAt())); ?> </span>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">

    <div class="row blog-entries element-animate">

      <div class="col-md-12 col-lg-8 main-content">

        <div class="post-content-body">
          <?php echo $wikidata->getContent() ?>
        </div>


        <div class="pt-5">
          <p>Categories: <a href="#"><?php echo $wikidata->getcategoryName(); ?></a>, <a href="#">Travel</a> Tags:
            <?php foreach ($wikidata->getTags() as $tag) : ?>
              <a href="#">#<?php echo $tag; ?></a>,
            <?php endforeach; ?>
          </p>
        </div>




      </div>

      <!-- END main-content -->

      <div class="col-md-12 col-lg-4 sidebar">
        <div class="sidebar-box search-form-wrap">
          <form action="#" class="sidebar-search-form">

            <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
          </form>
        </div>
        <!-- END sidebar-box -->

        <!-- END sidebar-box -->
        <div class="sidebar-box">
          <h3 class="heading">Popular Posts</h3>
          <div class="post-entry-sidebar">
            <ul>

              <?php
              $counter = 0;
              foreach ($AllWikies as $wiki) :
                if ($counter < 3) : ?>
                  <li>
                    <a href="">
                      <img src="/wiki/app/routes/<?php echo $wiki['wiki_image']; ?>" alt="Image placeholder" class="me-4 rounded">
                      <div class="text">
                        <h4><?php echo $wiki['title']; ?></h4>
                        <div class="post-meta">
                          <span class="mr-2"><?php echo date('M. dS, Y', strtotime($wiki['created_at'])); ?></span>
                        </div>
                      </div>
                    </a>
                  </li>
              <?php
                  $counter++;
                endif;
              endforeach;
              ?>

            </ul>
          </div>
        </div>
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
      <!-- END sidebar -->

    </div>
  </div>
</section>


<!-- Start posts-entry -->





<?php include 'includes/footer.php'; ?>


</body>

</html>