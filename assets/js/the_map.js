$(document).ready(function() {
  // click on full screen map

  if ($('#fullscreen-map').hasClass('active')) {
    window.mymap.gestureHandling.disable();
  }

  // then : mymap.gestureHandling.disable();
});
