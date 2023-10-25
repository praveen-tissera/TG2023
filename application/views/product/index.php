<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="stylesheet" href="<?php echo base_url() . '/css/bootstrap.min.css'?>">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <script src="<?php echo base_url() . '/js/jquery-3.7.0.js'?>"></script>
    <script src="<?php echo base_url() . '/js/popper.min.js'?>"></script>
    <script src="<?php echo base_url() . '/js/bootstrap.min.js'?>"></script>

    <style>
        .product-container{
            margin-top: 60px;
            clear: both;
            overflow-y: auto;
        }

        .product{
            height: 250px;
            margin: 20px 40px;
            border-radius: 15px;
			box-shadow: 0 0.5rem 1rem hsl(0 0% 0% / 20%);
            align-items: center;
            
            background-color: #ffffff;
            position: relative;

            padding-left: 250px;

            text-overflow: ellipsis;
        }

        .product-actions{
            display: flex;
            flex-direction: row;
            position: absolute;
            right: 0;
            top: 0;
        }

        .product-actions button {
            background-color: #e4e1d6;
            color: #22211d;
            border-color: #e4e1d6;
            width: 44px;
            height: 38px;
        }
        
        .product-actions a {
            width: 44px;
            height: 38px;
            background-color: #e4e1d6;
            color: #22211d;
            border-color: #e4e1d6;
        }
        .product-image{
            overflow: hidden;
            height: 250px;
            width: 250px;

            position: absolute;
            left: 0;
            top: 0;

            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .product-image img{
            width: 100%;
            height: 100%;
        }

        .product-details{
            height: 210px;            
            overflow: auto;
            margin: 20px;
        }

        .alert{
				text-align: center;
				max-width: 300px;
				left: 50%;
				transform: translate(-50%, -0%);
		}

        #scrollToTopBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: #555;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
        }

        .center {
            position: absolute;
            top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);	
			text-align: center;
        }
    </style>
</head>
<body style="background-color: #f0f0f0;">
    <div class="container mt-5">
        <h2>Products</h2>

        <?php 
		if(isset($message)){
			echo '<div class="alert alert-info">'.$message.'</div>';
		}
		if(isset($error)){
			echo '<div class="alert alert-warning">'.$error.'</div>';
		}
		?>

        <button id="scrollToTopBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
        <button class="btn btn-warning float-right" data-toggle="modal" data-target="#newProductModal">Add product</button>

        <div class="product-container">
            <?php if(count($products) == 0):?>
                <h2 class="display-4 center">No products to display</h2>
            <?php endif;?>

            <?php foreach($products as $product):?>

            <div class="product row col-xs-8 fadeA" onmouseenter="showActions(this)" onmouseleave="hideActions(this)">
                <div class="product-actions d-none">
                    <button class="btn" data-toggle="modal" data-target="#editProductModal" 
                    data-id="<?php echo $product->id?>" data-image="<?php echo $product->image ?>" 
                    data-name="<?php echo html_escape($product->name) ?>" data-description="<?php echo html_escape($product->description) ?>"
                    style="border-top-right-radius: 0;border-bottom-right-radius: 0;">
                        <i class="fas fa-pen" style="font-size: 18px;"></i>
                    </button>
                    <form action="<?php echo base_url().'product/remove/'?>" method="post" style="padding: 0; margin:0;">
                    <input type="hidden" name="id" value="<?php echo $product->id?>">
                    <button type="submit" class="btn"
                    style="border-top-left-radius: 0;border-bottom-left-radius: 0;padding: 0; margin:0;">
                    <i class="fas fa-trash" style="font-size: 18px;"></i>
                    </button>
                    </form>
                </div>
                <div class="product-image ">
                    <img src="<?php echo base_url().'/images/products/'.$product->image ?>" alt="Product Image 1" class="productImage" style="max-width: 250px; max-height: 250px;">
                </div>
                <div class="product-details">
                    <h4><?php echo html_escape($product->name) ?></h4>
                    <p><?php echo html_escape($product->description) ?><p>
                </div>
            </div>

            <?php endforeach;?>
        </div>

        <div class="modal fade" id="newProductModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url().'product/add'?>" method="post" enctype="multipart/form-data" onsubmit="saveRandomImage()">
                <div class="modal-body">    
                    <div class="form-group">
                        <input type="hidden" name="filename" id="add-productImage-name">
                        <div class="profile-pic-wrapper">
                        <div class="pic-holder">
                            <!-- uploaded pic shown here -->
                            <img id="add-productImage" class="pic" src="https://source.unsplash.com/random/250x250/?product" crossorigin="anonymous">

                            <input class="uploadProfileInput" type="file" name="image" id="newProductImage" accept="image/*" style="opacity: 0;" />
                            <label for="newProductImage" class="upload-file-block">
                                <div class="text-center">
                                    <div class="mb-2">
                                    <i class="fa fa-camera fa-2x"></i>
                                    </div>
                                    <div class="text-uppercase">
                                    Select <br /> Product image
                                    </div>
                                </div>
                            </label>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product-name" class="col-form-label">Product name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="product-description" class="col-form-label">Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url().'product/edit'?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="">
                    <div class="form-group">
                        <div class="profile-pic-wrapper">
                        <div class="pic-holder">
                            <!-- uploaded pic shown here -->
                            <img id="product-image" class="pic">

                            <input class="uploadProfileInput" type="file" name="image" id="editProductImage" accept="image/*" style="opacity: 0;" />
                            <label for="editProductImage" class="upload-file-block">
                                <div class="text-center">
                                    <div class="mb-2">
                                    <i class="fa fa-camera fa-2x"></i>
                                    </div>
                                    <div class="text-uppercase">
                                    Update <br /> Product image
                                    </div>
                                </div>
                            </label>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product-name" class="col-form-label">Product name</label>
                        <input type="text" name="name" class="form-control" id="product-name" >
                    </div>
                    <div class="form-group">
                        <label for="product-description" class="col-form-label">Description</label>
                        <textarea name="description" class="form-control" id="product-description"></textarea>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
    		// show the alert
			$(".alert").delay(2000).fadeOut(1000, function() {
				$(this).alert('close');
			});
		});

        $(window).on("load",function() {
            function fade() {
                var animation_height = $(window).innerHeight() * 0.25;
                var ratio = Math.round( (1 / animation_height) * 10000 ) / 10000;

                $('.fadeA').each(function() {

                    var objectTop = $(this).offset().top;
                    var windowBottom = $(window).scrollTop() + $(window).innerHeight();

                    if ( objectTop < windowBottom ) {
                        if ( objectTop < windowBottom - animation_height ) {
                            $(this).css( {
                                transition: 'opacity 0.1s linear',
                                opacity: 1
                            } );

                        } else {
                            $(this).css( {
                                transition: 'opacity 0.25s linear',
                                opacity: (windowBottom - objectTop) * ratio
                            } );
                        }
                    } else {
                        $(this).css( 'opacity', 0 );
                    }
                });
            }

            $('.fadeA').css( 'opacity', 0 );
            fade();

            $(window).scroll(function() {
                fade();
                if ($(this).scrollTop() > 20) {
                    $('#scrollToTopBtn').fadeIn();
                } else {
                    $('#scrollToTopBtn').fadeOut();
                }
            });

            $('#scrollToTopBtn').click(function() {
                $('html, body').animate({ scrollTop: 0 }, 560);
                return false;
            });
        });

        if ( window.history.replaceState ) {
			window.history.replaceState( null, null, window.location.href );
		}

        function showActions(product){
            product.children[0].classList.remove('d-none');
        }

        function hideActions(product){
            product.children[0].classList.add('d-none');
        }

        function escapeHtml(text) {
            var map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            
            return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }

        $('#editProductModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')  
            var src = "http://localhost/TG2023/images/products/" + button.data('image')
            var name = button.data('name')
            var description = button.data('description')

            var modal = $(this)
            modal.find('#id').val(id)
            modal.find('#product-name').val(name)
            modal.find('#product-description').text(description)
            modal.find('#product-image').attr('src', src);
        })

        var addProductImageChanged = false;

        $('#newProductImage').on('change', function (event){
            addProductImageChanged = true;
            cloneImage(event);
        });

        $('#editProductImage').on('change', function (event){
            cloneImage(event);
        });
        
        function saveRandomImage(){
            
            if(addProductImageChanged)
                return;

            var img = document.getElementById('add-productImage');
            var canvas = document.createElement('canvas');
            canvas.width = 250;
            canvas.height = 250;

            var ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0);

            var dataURL = canvas.toDataURL("image/png");

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost/TG2023/product/saveImage', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); // Server response
                } else {
                    console.error('Error: ' + xhr.status); // Error handling
                }
                }
            };
            var name = Math.floor(new Date().getTime() / 1000);
            xhr.send('image=' + dataURL + '&filename=' + name);

            $('#add-productImage-name').val('image_' + name + '.png');
        }

        function cloneImage(event) {
            var triggerInput = event.target;
            var currentImg = triggerInput.closest(".pic-holder").querySelector(".pic")
            .src;
            var holder = triggerInput.closest(".pic-holder");
            var wrapper = triggerInput.closest(".profile-pic-wrapper");

            triggerInput.blur();
            var files = triggerInput.files || [];
            if (!files.length || !window.FileReader) {
            return;
            }

            if (/^image/.test(files[0].type)) {
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);

            reader.onloadend = function () {
                holder.classList.add("uploadInProgress");
                holder.querySelector(".pic").src = this.result;

                var loader = document.createElement("div");
                loader.classList.add("upload-loader");
                loader.innerHTML =
                '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>';
                holder.appendChild(loader);

                setTimeout(function () {
                holder.classList.remove("uploadInProgress");
                loader.remove();

                }, 1500);
            };
            } else {
            wrapper.innerHTML +=
                '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose a valid image.</div>';
            setTimeout(function () {
                var invalidAlert = wrapper.querySelector('[role="alert"]');
                if (invalidAlert) {
                invalidAlert.remove();
                }
            }, 3000);
            }
        }
    </script>

    <style>
    .profile-pic-wrapper {
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .pic-holder {
        text-align: center;
        position: relative;
        border-radius: 50%;
        width: 150px;
        height: 150px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .pic-holder .pic {
        height: 100%;
        width: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: center;
        object-position: center;
    }

    .pic-holder .upload-file-block,
    .pic-holder .upload-loader {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(90, 92, 105, 0.7);
        color: #f8f9fc;
        font-size: 12px;
        font-weight: 600;
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .pic-holder .upload-file-block {
        cursor: pointer;
    }

    .pic-holder:hover .upload-file-block,
    .uploadProfileInput:focus ~ .upload-file-block {
        opacity: 1;
    }

    .pic-holder.uploadInProgress .upload-file-block {
        display: none;
    }

    .pic-holder.uploadInProgress .upload-loader {
        opacity: 1;
    }
    </style>
</body>
</html>