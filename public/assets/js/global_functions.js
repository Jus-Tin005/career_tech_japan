/* Begin:Theme Switcher */
const themeSwitcher = document.getElementById('theme-switcher');
const themeIcon = document.getElementById('theme-icon');

function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

    document.documentElement.setAttribute('data-theme', newTheme);

    if (newTheme === 'dark') {
        themeIcon.classList.replace('bi-sun-fill', 'bi-moon-fill');
        themeSwitcher.classList.replace('btn-dark', 'btn-light');
    } else {
        themeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
        themeSwitcher.classList.replace('btn-light', 'btn-dark');
    }

    localStorage.setItem('theme', newTheme);
}

window.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);

    if (savedTheme === 'dark') {
        themeIcon.classList.replace('bi-sun-fill', 'bi-moon-fill');
        themeSwitcher.classList.replace('btn-dark', 'btn-light');
    } else {
        themeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
        themeSwitcher.classList.replace('btn-light', 'btn-dark');
    }
});

themeSwitcher.addEventListener('click', toggleTheme);
/* End:Theme Switcher */


/* Begin:Sidebar Menu */
const sidebarItems = document.querySelectorAll('.sidebar-nav .sidebar-item');
const loader = document.getElementById('page-loader');


function showLoader(){
    loader.style.display = 'flex';
}



sidebarItems.forEach(item => {
    item.addEventListener('click',function(e){
        // Prevent immediate navigation
        e.preventDefault();

        showLoader();

        // Redirect after a short delay
        const link = this.querySelector('.sidebar-link');
        setTimeout(()=>{
            window.location.href = link
        }, 1000);
    });
});


// Function to update the active state based on the current URL
function updateActiveSidebarItem(){
    // Get the current URL
    const currentUrl = window.location.href;

    sidebarItems.forEach(item=>{
        // Get the link inside item
        const link = item.querySelector('.sidebar-link');

        if(link && currentUrl.includes(link.href)){
             // Remove 'active' class from all items
            sidebarItems.forEach(i=>i.classList.remove('active'));

            // Add 'active' class to the clicked item
            item.classList.add('active');
        }
    });
}





// Update the active state on page load
updateActiveSidebarItem();

/* End:Sidebar Menu */

/* Begin:Scroll to Top button */
const scrollToTopBtn = document.getElementById('scroll-to-top');

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        scrollToTopBtn.classList.add('show');
    } else {
        scrollToTopBtn.classList.remove('show');
    }
});

scrollToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
/* End:Scroll to Top button */


