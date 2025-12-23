async function addToCart(productCode, opts = {}) {
  const payload = {
    product_code: productCode,
    quantity: opts.quantity ?? 1,
    size: opts.size ?? null,
  };

  const res = await fetch("/cart/add", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify(payload)
  });

  const data = await res.json();
  if (!res.ok) {
    alert(data.message || "Gagal add to cart");
    return;
  }

  // Optional: tampilkan notif dan update badge cart
  alert("Added to cart ✅");
  if (data.cart_count !== undefined) {
    const badge = document.querySelector("#cart-count");
    if (badge) badge.textContent = data.cart_count;
  }
}
