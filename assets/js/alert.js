function showAlert(text,params={}) {
  params.color ||= 'black'
  params.speed ||= 300 
  params.time  ||= 5
  params.pos   ||= "left"
  params.round ||= 5 
  
  let alert  = document.createElement('div')
  let textEl = document.createElement('span')
  
  textEl.style = `padding:20px;color:#fff;font-weight:bold;`
  textEl.innerHTML = text || "test alert"
  alert.append(textEl)
  document.body.append(alert)

  let alertWidth = textEl.offsetWidth || 0

  alert.style = 
  `position:absolute;padding:20px 0;border-radius:${
    params.pos == "left" 
    ? `0 ${params.round}px ${params.round}px 0` 
    : `${params.round}px 0 0 ${params.round}px`
  };background:${params.color || "green"};top:10vh;${
    `${params.pos}:-${alertWidth}px;`
  }z-index:999999999;transition:${params.pos} ${params.speed}ms ease-in-out 0s`

  setTimeout(() => { alert.style[params.pos] = 0 }, 10);  
  setTimeout(() => { alert.style[params.pos] = `-${alertWidth}px`},params.time*1000-10)
  setTimeout(() => { alert.remove() }, params.time*1000+params.speed-10) 
}