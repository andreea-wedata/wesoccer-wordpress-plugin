console.log("WORKS");

document.addEventListener('DOMContentLoaded', () => {

  if (document.getElementById('timeline')) {
    const tmlList = document.getElementById('timeline');
    const list = document.getElementById('list');
    const links = document.getElementsByClassName('timeline__link');
    const today = links[10];

    const listInViewportWidth = tmlList.offsetWidth;
    const listWidth = list.offsetWidth;
    const itemWidth = today.offsetWidth;
    const prevBtn = document.getElementById('prev_btn');
    const nextBtn = document.getElementById('next_btn');

    window.addEventListener('load', centerSelectedDate);
    window.addEventListener('resize', centerSelectedDate);

    centerSelectedDate();

    // add an active class to the centered date
    // today.classList.add('timeline__link--active');

    // add click events to prev and next buttons
    prevBtn.addEventListener('click', () => {
      tmlList.scrollLeft -= itemWidth;
    });

    nextBtn.addEventListener('click', () => {
      tmlList.scrollLeft += itemWidth;
    });

    function centerSelectedDate() {
      // check width of DOM elements
      const listInViewportWidth = tmlList.offsetWidth;
      const listWidth = list.offsetWidth;
      let cellsNum;

      // check number of cells in viewport
      cellsNum = listInViewportWidth / itemWidth;

      // calculate the scrollLeft position based on num of cells in viewport
      tmlList.scrollLeft = listWidth / 2 - cellsNum / 2 * itemWidth;
    }
  }

});


