(function () {

    const parent = document.querySelector('.contacts__ya-map');
    if (!parent) return;

    const coord = document.querySelector('.contacts__coords')
        .innerHTML.replace(/\s/g, '').split(',');

    const dataOffice = document.querySelector('.contacts__office').innerHTML;

    function init() {

        let myMap = new ymaps.Map("map", {
            center: coord,
            zoom: 14,
            controls: []
        });
        
        let myPlacemark = new ymaps.Placemark(coord, {
            balloonContent: dataOffice,
        }, {
            iconLayout: 'default#image',
            iconImageHref: './assets/template/images/ya-metka.png',
            iconImageSize: [80, 90],
            iconImageOffset: [-30, -100]
        })

        myMap.geoObjects.add(myPlacemark)

        myMap.controls.add('zoomControl', {
            position: {
                right: '20px',
                top: '20px'
            }
        })
    }

    ymaps.ready(init);

}());