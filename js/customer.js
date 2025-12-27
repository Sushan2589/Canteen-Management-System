document.addEventListener("DOMContentLoaded", () => {
let plusBtns = document.querySelectorAll(".qty-btn.plus");
let minusBtns = document.querySelectorAll(".qty-btn.minus")
let qtyEls = document.querySelectorAll(".qty");
let addBtn = document.querySelectorAll(".add-btn")
let orderList = document.querySelector(".order-list");


// plusBtns.forEach((btn, index) => {
//   btn.addEventListener("click", () => {
//     let currentQty = parseInt(qtyEls[index].textContent);
//     qtyEls[index].textContent = currentQty + 1;
//   });
// });

// minusBtns.forEach((btn, index) => {
//   btn.addEventListener("click", () => {
//     let currentQty = parseInt(qtyEls[index].textContent);
//     if(currentQty>0)
//     {
//         qtyEls[index].textContent = currentQty - 1;
//     }

//     if(currentQty==0)
//     {
//       //remove the order item
//     }
    
//   });
// });

orderList.addEventListener("click",(e)=>{
  if(e.target.closest(".plus"))
  {
    const qty = e.target.closest(".qty-controls").querySelector(".qty");
    qty.textContent = Number(qty.textContent) + 1;

  }

  if(e.target.closest(".minus"))
  {
    const qty = e.target.closest(".qty-controls").querySelector(".qty");
     const cardItem = e.target.closest(".sidebar-item");
    if (qty.textContent > 1) {
      qty.textContent = Number(qty.textContent) - 1;
    }

    else
    {
      cardItem.remove()
    }

  
    
  
  }
})


addBtn.forEach((btn,index)=>{
  btn.addEventListener("click",()=>{
    
    let itemNames = document.querySelectorAll(".card-info-header")
    let itemName = itemNames[index].textContent

    let itemPrices = document.querySelectorAll(".price")
    let itemPrice = itemPrices[index].textContent
   
    const sideBarItems = orderList.getElementsByClassName("sidebar-item")
    let found = false;
    for(let i=0;i<sideBarItems.length;i++)
    {
      let nameSearch = sideBarItems[i].getElementsByClassName("item-name")[0]

      if(nameSearch.textContent === itemName)
      {
        //found increase quanitity
        let foundQty = sideBarItems[i].getElementsByClassName("qty")[0]
        foundQty.textContent = Number(foundQty.textContent)+1;
        found = true;
        break
      }
    }

    if(!found)
    {
      orderList.insertAdjacentHTML("beforeend", `
    <div class="sidebar-item">
      <div class="item-details">
        <span class="item-name">${itemName}</span>
        <span class="item-price">${itemPrice}</span>
      </div>
      <div class="qty-controls">
        <button class="qty-btn minus">
          <i class="fa-solid fa-minus"></i>
        </button>
        <span class="qty">1</span>
        <button class="qty-btn plus">
          <i class="fa-solid fa-plus"></i>
        </button>
      </div>
    </div>
  `)
    }
    



  })
})

})