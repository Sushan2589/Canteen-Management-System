document.addEventListener("DOMContentLoaded", () => {
  
  const addBtns = document.querySelectorAll(".add-btn");
  const orderList = document.querySelector(".order-list");
  const totalEl = document.querySelector(".total");
  const badgeEl = document.getElementById("badge");

  function updateTotal() {
    const items = document.querySelectorAll(".sidebar-item");
    let total = 0;

    items.forEach(item => {
      const priceText = item.querySelector(".item-price").textContent;
      const price = Number(priceText.replace("Rs.", "").trim());
      const qty = Number(item.querySelector(".qty").textContent);

      total += price * qty;
    });

    totalEl.textContent = `Rs. ${total}`;
    badgeEl.textContent = `${items.length} Items`;
  }

  // Event delegation for + and -
  orderList.addEventListener("click", (e) => {
    if (e.target.closest(".plus")) {
      const qty = e.target.closest(".qty-controls").querySelector(".qty");
      qty.textContent = Number(qty.textContent) + 1;
      updateTotal();
    }

    if (e.target.closest(".minus")) {
      const qty = e.target.closest(".qty-controls").querySelector(".qty");
      const item = e.target.closest(".sidebar-item");

      if (Number(qty.textContent) > 1) {
        qty.textContent = Number(qty.textContent) - 1;
      } else {
        item.remove();
      }
      updateTotal();
    }
  });

  addBtns.forEach((btn, index) => {
    btn.addEventListener("click", () => {
      const itemName = document.querySelectorAll(".card-info-header")[index].textContent;
      const itemPrice = document.querySelectorAll(".price")[index].textContent;

      const sidebarItems = document.querySelectorAll(".sidebar-item");
      let found = false;

      sidebarItems.forEach(item => {
        if (item.querySelector(".item-name").textContent === itemName) {
          const qty = item.querySelector(".qty");
          qty.textContent = Number(qty.textContent) + 1;
          found = true;
        }
      });

      if (!found) {
        orderList.insertAdjacentHTML("beforeend", `
          <div class="sidebar-item">
            <div class="item-details">
              <span class="item-name">${itemName}</span>
              <span class="item-price">${itemPrice}</span>
            </div>
            <div class="qty-controls">
              <button class="qty-btn minus"><i class="fa-solid fa-minus"></i></button>
              <span class="qty">1</span>
              <button class="qty-btn plus"><i class="fa-solid fa-plus"></i></button>
            </div>
          </div>
        `);
      }

      updateTotal();
    });
  });


//CART

function getCartData() {
  const items = document.querySelectorAll(".sidebar-item");
  let cart = [];

  items.forEach(item => {
    const name = item.querySelector(".item-name").textContent;
    const priceText = item.querySelector(".item-price").textContent;
    const price = Number(priceText.replace("Rs.", "").trim());
    const qty = Number(item.querySelector(".qty").textContent);

    cart.push({
      name: name,
      price: price,
      quantity: qty,
      total: price * qty
    });
  });

  return cart;
}




const placeOrderBtn = document.getElementById("place-order");


console.log("Button:", placeOrderBtn);

if (placeOrderBtn) {
  placeOrderBtn.addEventListener("click", () => {
    let totalAmount = document.querySelector(".total").innerText;
    const cart = getCartData();

    if (cart.length === 0) {
      alert("Your cart is empty!");
      return;
    }
    const confirmOrder = confirm("Are you sure you want to place this order?");

  if (!confirmOrder) {
    return;   // stop here if user clicks Cancel
  }
  
    fetch("checkout.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify(cart)
})
.then(response => response.text())
.then(orderId => {
  orderId = orderId.trim();
  window.location.href = "receipt.php?order_id=" + orderId;
})
.catch(error => {
  console.error("Fetch error:", error);
});

  });
}



  


});
