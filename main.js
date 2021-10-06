for (let n = 1; n < 10; n++) {
  let items = document.querySelectorAll(`.category${n} h2`);
  for (let i = 1; i < items.length; i++) {
    items[i].remove();
  }
}