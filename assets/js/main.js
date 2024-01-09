feather.replace() // ФУНКЦІЯ ЯКА ВСТАВЛЯЄ ІКОНКИ




// БЛОК КОДУ ДЛЯ РОБОТИ КНОПКИ МЕНЮ 

let burger_btn = document.querySelector('.burger_btn')
let mobile_menu = document.querySelector(".menu_links")

burger_btn.onclick = function(){
  if (!this.classList.toggle("active")) {
    mobile_menu.style.right = "100%"
    document.body.style.position = ""
  }
  else {
    mobile_menu.style.right = "0%"
    document.body.style.position = "fixed"
  }
}
// ---------------------------------------















// БЛОК ВІДКРИТТЯ ТА ЗАКРИТТЯ ЗЕЛЕНОГО АЛЕРТА КОЛИ ДОДАЄШ ДО КОРЗИНИ
let addToCartBtn    = document.querySelector("#addToCartBtn")
let alert_green     = document.querySelector('.alert_green')
let alert_green_div = document.querySelector('.alert_green div')
let sizes_btns      = document.querySelectorAll("#sizes_btns input[type=\"radio\"]")

let choseed_size = ""



if(addToCartBtn && sizes_btns) {
  addToCartBtn.onclick = () => addToCart()

  sizes_btns.forEach(btn => {
    btn.onclick = function(){ choseed_size = this.id }
  })
}




function removeFromCart(itemId, btn) {
  btn.disabled = true

  let duration = 1000

  let item = document.querySelector(`[data-cartItem="${itemId}"]`)

  item.style.position = "relative"
  item.style.left = "0vw"
  item.style.transition = `left ${duration}ms cubic-bezier(1,-0.5,0,1)`

  
  // let cart = []
  let cart = {}

  UpdTotalPrice(item.querySelector('#discount_price').innerText)
  

  setTimeout(() => { item.style.left = "100vw" }, 5);
 
  setTimeout(() => {

    const cart_json = document.cookie.replace(/(?:(?:^|.*;\s*)cart\s*\=\s*([^;]*).*$)|^.*$/, "$1")

    if (cart_json) {
      
      let parsed = JSON.parse(cart_json)
      
      // console.log(parsed);

      for (const product_index in parsed) {
        cart[product_index] = parsed[product_index]
      }

      console.log(cart["25"]);
    }

    let cart_count = document.querySelector("#cart_count")

    if (cart_count.innerText > 0) {
      cart_count.innerText = Number(cart_count.innerText) - 1
    }
    
    if (cart_count.innerText == 0) {
      chargeCartStatus()
    }

    // cart.splice(Number(itemId), 1)
    

    delete cart[Number(itemId)]
    document.cookie = `cart=${JSON.stringify(cart)}; max-age=2628000; path=/`
    console.log(document.cookie);

    item.remove()

  }, duration);
}





document.querySelectorAll("[data-delBtn]").forEach(btn => {
  btn.onclick = function() {
    const itemId = this.getAttribute("data-delBtn")
    removeFromCart(itemId, this)
  }
})



function addToCart() {
  let cart = {}
  let maxKey = 0

  const urlParams = new URLSearchParams(window.location.search)
  const product_id = urlParams.get('id')

  let cart_count = document.querySelector("#cart_count")
  let count = Number(cart_count.innerText)
  cart_count.innerText = count + 1

  const cart_json = document.cookie.replace(/(?:(?:^|.*;\s*)cart\s*\=\s*([^;]*).*$)|^.*$/, "$1")
  
  if (cart_json) {
    cart = JSON.parse(cart_json)
  
    for (const key in cart) {
      if (key > maxKey) {
        maxKey = Number(key)
      }
    }
  }

  cart[maxKey+1] = [product_id, choseed_size]

  document.cookie = `cart=${JSON.stringify(cart)}; max-age=2628000; path=/`

  if (innerWidth <= 768) {
    alert_green.style.bottom = '0%'

    setTimeout(() => {
      alert_green.style.bottom = '-50%'
    }, 5000);
  }
  else {
    alert_green_div.style.width = '110%'

    setTimeout(() => {
      alert_green_div.style.width = '0%'
    }, 5000);
  }
}



// ---------------------------------------










// ОНОВЛЕННЯ ЗАГАЛЬНОЇ ВАРТОСТІ В КОРЗИНІ

function UpdTotalPrice(deleted_price, operator = "-") {
  const total_price = document.querySelectorAll('#total_price')
  let num = 0

  total_price.forEach(txt => {
    if (operator === "-") {
      num = Number(txt.innerText) - Number(deleted_price)
    }
    else {
      num = Number(txt.innerText) + Number(deleted_price)
    }
    txt.innerText = num
  })
}

// --------------------------------------




// ФУНКЦІЯ ЗМІНИ СТАТУСУ КОРЗИНИ (ПУСТА/НЕ ПУСТА)

function chargeCartStatus() {
  document.querySelector('#block_total_price')
  .innerHTML = "<p class='ta-center mt-150 fs-18 c-gray'>Корзина пуста</p>"
}

// --------------------------------------


// БЛОК ВІДКРИТТЯ ТА ЗАКРИТТЯ ВІКНА ОФОРМЛЕННЯ ЗАМОВЛЕННЯ

function openOffer() {
  offer_modal.style.display = ""
  document.body.style.overflow = "hidden"
  
  setTimeout(() => {
    offer_modal_window.style.bottom = "0vh"
  }, 10);
}

function closeOffer() {
  offer_modal_window.style.bottom = "-100vh"

  setTimeout(() => {
    offer_modal.style.display = "none"
    document.body.style.overflow = ""
  }, 500);
}
// ---------------------------------------


// })





// БЛОК КОДУ ДЛЯ СЛАЙДЕРУ 
 
if (typeof Swiper !== 'undefined') { 
 
    const swiper = new Swiper('.swiper', { 
      loop: true, 
      pagination: { 
        el: '.swiper-pagination', 
      }, 
      navigation: { 
        nextEl: '.swiper-button-next', 
        prevEl: '.swiper-button-prev', 
      }, 
      mousewheel: { 
        invert: false, 
      }, 
    }); 
 
} 
 
// ---------------------------------------