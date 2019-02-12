function initMap() {
  var Cabinet = {lat: 48.584689, lng: -2.535084};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: Cabinet
  });

  var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<div id="bodyContent">'+
      '<p><b>Cabinet Nolwenn Thomas</b>,8 place de Lourmel, 22370 Pléneuf-Val-André .</p>'+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

  var marker = new google.maps.Marker({
    position: Cabinet,
    map: map,
    title: 'Cabinet Nolwenn Thomas'
  });
  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });
}
    