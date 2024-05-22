function toggleMenu() {
    const menu = document.getElementById('menu');
    const menuWidth = menu.offsetWidth;
  
    if (menuWidth === 250) {
      menu.style.width = '50px';
      hideMenuText();
    } else {
      menu.style.width = '250px';
      showMenuText();
    }
  }
  
  function hideMenuText() {
    const menuTexts = document.querySelectorAll('.menu-text');
    menuTexts.forEach(text => {
      text.style.display = 'none';
    });
  }
  
  function showMenuText() {
    const menuTexts = document.querySelectorAll('.menu-text');
    menuTexts.forEach(text => {
      text.style.display = 'inline-block';
    });
  }
  