document.addEventListener('DOMContentLoaded', function () {
    const sliders = document.querySelectorAll('.slider-with-arrows');
    sliders.forEach(sliderWrapper => {
        const slidesContainer = sliderWrapper.querySelector('.slides');
        const prevButton = sliderWrapper.querySelector('.prev');
        const nextButton = sliderWrapper.querySelector('.next');
        const slideItems = slidesContainer.querySelectorAll('img');
        let currentIndex = 0;

        function updateSliderPosition() {
            const slideWidth = slidesContainer.clientWidth;
            slidesContainer.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        }

        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSliderPosition();
            }
        });

        nextButton.addEventListener('click', () => {
            if (currentIndex < slideItems.length - 1) {
                currentIndex++;
                updateSliderPosition();
            }
        });

        updateSliderPosition();
        window.addEventListener('resize', updateSliderPosition);
    });
});
