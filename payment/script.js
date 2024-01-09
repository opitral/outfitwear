let card_number = document.getElementById("card_number")

let number_ph_span = document.getElementById("card_number_ph")
let number_ph_text = number_ph_span.innerText

card_number.oninput = (e) => {
  let val = card_number.value
  card_number.value = format(val, 'card')

  let ph_str = ''

  for (const l in number_ph_text) {
    ph_str += (card_number.value[l] || number_ph_text[l] === " ") ? '&nbsp;' : '_'
  }

  number_ph_span.innerHTML = ph_str

  if (val.length > 19) {
    card_number.value = val.slice(0, -1)
  }
}















let card_data = document.getElementById("card_data")

let data_ph_span = document.getElementById("card_data_ph")
let data_ph_text = data_ph_span.innerText

card_data.oninput = (e) => {
  let val = card_data.value
  card_data.value = format(val, 'cvv')

  let ph_str = ''

  for (const l in data_ph_text) {
    ph_str += !(card_data.value[l] || data_ph_text[l] === "/") ?  '' : data_ph_text[l] === "/" ? "/" : '&nbsp;'
    
    console.log(card_data.val[l]);
  }
  

  // for (const l in data_ph_text) {
  //   ph_str += (val[l]) ? '&nbsp;' : data_ph_text[l] !== " " ? '_' : '/'
  //   console.log(data_ph_text[l]);
  // }

  // console.log(ph_str)

  data_ph_span.innerHTML = ph_str

  if (val.length > 5) {
    card_data.value = val.slice(0, -1)
  }
}















let card_cvv = document.getElementById("card_cvv")

card_cvv.oninput = (e) => {
  let val = card_cvv.value
  if (val.length > 3) {
    card_cvv.value = val.slice(0, -1)
  }
}



















function format(cn, type) {
  const cleaned = cn.replace(/\D/g, '');
  if (!cleaned) return ""
  let group
  if (type === "card") {
    groups = cleaned.match(/.{1,4}/g);
  }
  else groups = cleaned.match(/.{1,2}/g);

  const formatted = groups.join(' ');
  return formatted;
}