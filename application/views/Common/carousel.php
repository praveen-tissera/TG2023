<style>
  .bottom-space {
    margin-bottom: 1cm;
  }
</style>
<div class="bottom-space">
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="<?php echo base_url() . 'images\carousel\446319_l-scaled.jpg ' ?>" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="<?php echo base_url() . 'images\carousel\great-western-estate.jpg' ?>" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="<?php echo base_url() . 'images\carousel\sunset-at-tata-tea-gardens.jpg ' ?>" alt="Third slide">
      </div>
    </div>
  </div>
</div>


<script>
  $('.carousel').carousel({
    interval: 2000
  })
</script>