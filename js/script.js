const i = 0;
const images = [];
const slideTime = 3000; // 3 seconds

images[0] = 'https://unsplash.com/photos/a-person-standing-on-top-of-a-sandy-beach-cC9Dmhbww8g';
images[1] = 'https://unsplash.com/photos/a-snow-covered-field-with-trees-in-the-background-Uvx36KXixh8';
images[2] = 'https://unsplash.com/photos/a-night-sky-filled-with-stars-and-trees-eKbt1g1RT6I';

function changePicture() {
    document.body.style.backgroundImage = "url(" + images[i] + ")";

    if (i < images.length - 1) {
        i++;
    } else {
        i = 0;
    }
    setTimeout(changePicture, slideTime);
}

window.onload = changePicture;