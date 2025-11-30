document.addEventListener('DOMContentLoaded',function(){
const slides = document.querySelectorAll('.slide');
const prevBtn = document.querySelector('.slide-btn.prev');
const nextBtn = document.querySelector('.slide-btn.next');

let currentSlide = 0;

function showSlide(index){
    slides.forEach(slide => slide.classList.remove('active'));

    slides[index].classList.add('active');
}

prevBtn.addEventListener('click', () => {
    currentSlide--;

    if(currentSlide < 0){
        currentSlide=slides.length-1;
    }
    showSlide(currentSlide);
});

nextBtn.addEventListener('click',() => {
    currentSlide++;

    if(currentSlide >= slides.length){
        currentSlide = 0;
    }
    showSlide(currentSlide);
});
showSlide(currentSlide);
});