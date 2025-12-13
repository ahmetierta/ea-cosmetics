const ITEMS_PER_PAGE = 16;

let currentCategory= 'all';
let currentPage = 1;

const allProducts = document.querySelectorAll('.product-card');
const pagination = document.getElementById('pagination');

function renderProducts() {
    let filteredProducts = [];
    allProducts.forEach(product => {
        const categories = product.dataset.category;

        if(currentCategory === 'all' || categories.includes(currentCategory)) {
            filteredProducts.push(product);
        }
    });

    allProducts.forEach(product => {
        product.style.display = 'none';
    });

    if(currentCategory !== 'all'){
        filteredProducts.forEach(product => {
            product.style.display = 'block';
        });
        pagination.innerHTML ='';
        pagination.style.display = 'none';
        return;
    }
    const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
    const endIndex = startIndex + ITEMS_PER_PAGE;

    filteredProducts.slice(startIndex,endIndex).forEach(product => {
        product.style.display = 'block';
    });
    const totalPages = Math.ceil(filteredProducts.length / ITEMS_PER_PAGE);
    pagination.innerHTML = '';
    pagination.style.display = 'flex';
    for(let i = 1;i<=totalPages;i++){
        const btn = document.createElement('button');
        btn.textContent = i;
        if(i === currentPage){
            btn.classList.add('active');
        }
        btn.onclick = function(){
            currentPage = i;
            renderProducts();
        };
        pagination.appendChild(btn);
    }
}

function filterProducts(category){
    currentCategory = category;
    currentPage = 1;
    renderProducts();
    setActiveFilter(category);
    updateHeroTitle(category);
}
function setActiveFilter(category){
    const buttons = document.querySelectorAll('.category-card');

    buttons.forEach(btn => btn.classList.remove('active'));

    buttons.forEach(btn => {
        const onclickValue = btn.getAttribute('onclick') || '';
        if (onclickValue.includes(`'${category}`)){
            btn.classList.add('active');
        }
    });
}
function updateHeroTitle(category){
    const title = document.getElementById('hero-title');
    if(!title) return;

    switch(category) {
        case 'eyes':
            title.textContent = 'Eyes & Brows';
            break;
        case 'face':
            title.textContent = 'Face';
            break;
        case 'lips':
            title.textContent = 'Lips';
            break;
        case 'brushes':
            title.textContent = 'Brushes & Accessories';
            break;
        case 'sale':
            title.textContent = 'Sale';
            break;
        default:
            title.textContent = 'Products';
    }
}
document.addEventListener('DOMContentLoaded', function() {
    renderProducts();
    setActiveFilter('all');
    updateHeroTitle('all');
})