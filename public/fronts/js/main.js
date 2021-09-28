$(".banner").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  arrows: false,
  dots: true
});
if (screen.width > 768) {
  var mainImg = $("img.mainImg");
  for (var i = 0; i < mainImg.length; i++) {
    var controlImg = $(".slideGallery");
    $(mainImg[i]).attr("id", i);
    $(controlImg).append(
      '<div class="itemGallery"><img src="' +
        $(mainImg[i]).attr("src") +
        '" alt="" ></div>'
    );
  }
  slider(3);
  mainImg.click(function() {
    var bigParent = $("#containerImg");
    var mainId = parseInt($(this).attr("id"));
    bigParent.show();
    $(".slideGallery").slick("unslick");
    slider(mainId);
  });
  $("#closeGallery").click(function() {
    var bigParent = $("#containerImg");
    bigParent.hide();
    $(".slideGallery").slick("unslick");
  });
}
function slider(index) {
  $(".slideGallery").slick({
    initialSlide: index,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: true,
    dots: false,
    variableWidth: true,
    centerMode: true
  });
}
function total() {
  let ban = document.querySelector(".foter"),
    foterH = document.getElementsByClassName("foterTitle"),
    foterUl = document.getElementsByClassName("foterUl");
  if (screen.width < 768) {
    for (var i = 0; i < foterUl.length; i++) {
      foterUl[i].style.display = "none";
    }
  }
  function close() {
    for (var i = 0; i < foterUl.length; i++) foterUl[i].style.display = "none";
  }
  function foterFunction(event) {
    var dont = event.target;
    if (
      dont.nodeName == "H6" &&
      dont.nextElementSibling.style.display == "none"
    ) {
      close();
      dont.nextElementSibling.style.display = "block";
    } else if (dont.nodeName != "H6") {
      close();
    } else {
      dont.nextElementSibling.style.display = "none";
    }
  }
  if (screen.width < 768) {
    ban.addEventListener("click", foterFunction);
  }
}
$(document).ready(function() {
  total();
  var burger = $(".burger");
  var navHeader = $(".navHeader");
  var titleItem = $(".titleItem");
  var itemOpen = $(".itemOpen");
  var searchButt = $("#searchButt");
  $(titleItem).click(function() {
    $(this).toggleClass("minusBcg");
    $(this)
      .next(itemOpen)
      .toggle(500);
    $(this)
      .parent()
      .toggleClass("borderBlue");
  });
  $(searchButt).click(function() {
    $(this).addClass("searchOpen");
  });
  $(document).mouseup(function(e) {
    if (!searchButt.is(e.target) && searchButt.has(e.target).length === 0) {
      searchButt.removeClass("searchOpen");
      $("input#searchButt:text").val("");
      $("#searchOpen").css("display", "none");
    }
  });
  if (screen.width < 768) {
    $(".foterTitle").click(function() {
      if ($(this).hasClass("minusBcg") !== true) {
        $(".foterTitle").removeClass("minusBcg");
        $(this).addClass("minusBcg");
      } else {
        $(this).removeClass("minusBcg");
        $(".foterTitle").removeClass("minusBcg");
      }
    });
    $(burger).click(function() {
      navHeader.toggle(500);
      $(".searchLangMobile").toggle();
    });
    $(document).mouseup(function(e) {
      if (
        !burger.is(e.target) &&
        !navHeader.is(e.target) &&
        navHeader.has(e.target).length === 0
      ) {
        navHeader.hide(500);
        $(".searchLangMobile").css("display", "block");
      }
    });
  }
});
