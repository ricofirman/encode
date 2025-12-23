<?php
// Add to cart
        const addToCartBtn = document.querySelector('.btn-add-to-cart');
        addToCartBtn.addEventListener('click', function() {
            const size = document.querySelector('.size-btn.active').textContent;
            const quantity = quantityInput.value;
            
            alert(`Added to cart: The Ciper Blazer\nSize: ${size}\nQuantity: ${quantity}`);
            
            // Redirect to cart page
            // window.location.href = "{{ url('/cart') }}";
        });