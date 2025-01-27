// Select the search bar and the search icon
const searchWrapper = document.querySelector('.search-wrapper');
const searchInput = document.querySelector('.search-input');
const searchButton = document.querySelector('.search-button');

// Add an event listener to the search button
searchButton.addEventListener('click', () => {
    // Toggle the 'active' class on the search wrapper
    searchWrapper.classList.toggle('active');

    // Focus the search input when the wrapper is active
    if (searchWrapper.classList.contains('active')) {
        searchInput.focus();
    }
});
