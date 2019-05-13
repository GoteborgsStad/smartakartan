$(document).ready(function($) {
  var body = document.getElementsByTagName('body')[0];
  var cityBlock = document.querySelector('.acf-field-5beac5c82839e');

  var iframeWrapper = document.createElement('div');
  iframeWrapper.style.position = 'fixed';
  iframeWrapper.style.width = '100%';
  iframeWrapper.style.height = '100%';
  iframeWrapper.style.top = 0;
  iframeWrapper.style.left = 0;
  iframeWrapper.style.display = 'none';
  iframeWrapper.style.justifyContent = 'center';
  iframeWrapper.style.alignItems = 'center';
  iframeWrapper.style.backgroundColor = 'white';
  iframeWrapper.style.zIndex = 100;

  var iframeClose = document.createElement('div');
  iframeClose.innerText = 'Close';
  iframeClose.style.position = 'absolute';
  iframeClose.style.top = '100px';
  iframeClose.style.right = '40px';
  iframeClose.style.cursor = 'pointer';

  iframeClose.addEventListener('click', function() {
    iframeWrapper.style.display = 'none';
  });

  var iframe = document.createElement('iframe');
  iframe.style.height = '80vh';
  iframe.style.width = '60%';

  if (cityBlock) {
    var button = document.createElement('p');
    button.innerText = 'validera adress';
    button.style.cursor = 'pointer';
    button.addEventListener('click', function() {
      var street = document.querySelector('#acf-field_5beac5ab2839d').value;
      var city = document.querySelector('#acf-field_5beac5c82839e').value;
      iframe.src =
        'https://nominatim.openstreetmap.org/search?q=' + street + ',' + city;
      iframeWrapper.style.display = 'flex';
    });

    cityBlock.appendChild(button);
    iframeWrapper.appendChild(iframeClose);
    iframeWrapper.appendChild(iframe);
    body.appendChild(iframeWrapper);
  }
});
