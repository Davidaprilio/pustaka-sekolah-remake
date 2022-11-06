// touchsurface = document.getElementById('main');
// touchsurface.addEventListener("swap", function(event){
//     alert('Swaped ' + event.detail.direction + ' at ' + event.target.id);
// }, false);
const bUrl = 'http://' + window.location.host;
let tmpData = null;
var infoku = document.getElementById('tag-info');
const sidebarNavLink = $('#menu-book-stack .nav-link');
const containerBookList = document.getElementById('book-list');
const skeleteonPageDetail = document.getElementById('skeleton-page-detail');
const skeleteonPageAllBook = document.getElementById('skeleton-page-all-book');
const skeleteonPageStackBook = document.getElementById('skeleton-page-stack-book');
const loadingBar = document.getElementById('loading-bar');
const loadingProgress = document.getElementById('loading-page-value');

// Beres
function movePageStack(stackSlug) {
    if (stackSlug === 'semua-buku') {
        loading(7, 'all-book')
    } else {
        loading(7, 'stack-book')
    }
    window.scrollTo(0, 0)
    $.ajax({
        url: `${bashurl}/json/pustaka/etalase/${stackSlug}`,
        type: 'GET',
        dataType: 'html',
        success: function (response) {
            containerBookList.innerHTML = ''
            $('#book-list').html(response)
        },
        error: function (error) {
            console.log(error)
        },
        complete: function () {
            loading(100)
        }
    });
}

function addBookmark(id) {
    $.post(bUrl + '/User/addBookmark', { book: id }, function (data) {
        if (data == '0') {
            alert('Sudah ada');
        }
    });
}

// Beres
function errorView(text, code) {
    return $('#book-list').html(/*html*/`<div class="row justify-content-center text-dark align-items-center w-100 flex-column" style="height: 65vh;"><h2 class="display-1" style="text-shadow: 1px 1px 0 #ddd, 3px 3px 0 #ddd, 5px 5px 0 #ddd, 7px 7px 0 #ddd, 9px 9px 0 #ddd, 10px 10px 0 #ddd;">${code ?? '404'}</h2><p class="h2 text-muted" style="text-shadow: 1px 1px 0 #ddd, 2px 2px 0 #ddd, 3px 3px 0 #ddd;">` + text + `</p></div>`);
    die();
}

function movePageDetail(slugBook, slugStack) {
    window.scrollTo(0, 0);
    sidebarNavLink.removeClass('active');
    $(`[data-stack-slug=${slugStack}]`).addClass('active')
    loading(7, 'detail')
    updateURL(`${bashurl}/${slugStack}/${slugBook}`, {
        page: 'detail',
        book: slugBook,
        stack: slugStack
    });
    $.ajax({
        url: `${bashurl}/json/pustaka/book/${slugBook}`,
        type: 'GET',
        dataType: 'html',
        success: function (response) {
            containerBookList.innerHTML = ''
            $('#book-list').html(response)
        },
        complete: function () {
            loading(100)
        }
    });
}
function openBook(btn) {
    const newBtn = document.createElement("button");
    newBtn.classList.add('btn', 'btn-sm', 'btn-primary');
    newBtn.setAttribute('disabled', '');
    newBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Membuka...`;
    btn.parentNode.replaceChild(newBtn, btn);
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return false;
}
function saveResult(data) {
    tmpData = data;
}
function like(id) {
    let t = $('#valLike').html();
    t++;
    $('#valLike').html(t);
    const d = new Date();
    d.setTime(d.getTime() + ((365 + 182) * 24 * 60 * 60 * 1000));
    document.cookie = "Bk-" + id + "=true; expires=" + d.toUTCString();
    $('#heartFA').css('color', '#ffb8bf');
    $('#jasuh').attr('onClick', 'unlike("' + id + '")');
    let b = window.location.origin + '/Engine/likeAndunlike/' + id + '/plus'
    $.ajax({ url: b, type: 'get', dataType: 'ajax' });
}
function unlike(id) {
    let t = $('#valLike').html();
    t--;
    $('#valLike').html(t);
    document.cookie = "Bk-" + id + "=true; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/DetailBuku;";
    $('#heartFA').css('color', '#fff');
    $('#jasuh').attr('onClick', 'like("' + id + '")');
    let b = window.location.origin + '/Engine/likeAndunlike/' + id + '/min'
    $.ajax({ url: b, type: 'get', dataType: 'ajax' });
}
function searchBook(n, l) {
    $.ajax({
        url: bUrl + '/API/searchBook/' + n + '/' + l,
        type: 'get',
        dataType: 'json',
        success: function (result) {
            saveResult(result.keyword);
            if (result.status == 'OK') {
                $('#buku').html(`<div class="row" id="rowBook"></div>`);
                $.each(result.items, function (i, data) {
                    $('#rowBook').append(`
                        <div class="card d-inline-block shadow-sm mb-1 mx-1" >
                            <img src="`+ bUrl + data.sampulMin + `" class="card-img-top mx-auto">
                            <div class="p-2">
                                <p class="text-dark my-0 py-0 buku_title" id="titleBook" uisb="`+ data.idBuku + `" title="` + data.judulBuku + `">` + data.judulBuku + `</p>
                                <p href="#" class="d-block my-0 authorBook">
                                    <small class="text-muted">`+ data.penulis + `</small>
                                </p>
                            </div>
                        </div>
                    `);
                });
                if (result.count == 0) {
                    $('#buku').append(`<div class="d-flex w-100 align-items-center justify-content-center text-muted display-3" style="height: 60vh">Kosong</div>`);
                }
            }
        }
    });
}
function updateBreadcrumb(G, M, P = false) {
    $('.breadcrumb').empty();
    $('.breadcrumb').html(`
        <li class="breadcrumb-item">Pustaka</li>
    `);
    if (G != null) {
        $('.breadcrumb').append(`
            <li class="breadcrumb-item" id="katGrub">`+ G + `</li>
        `);
    }
    if (P) {
        $('.breadcrumb').append(`
            <li class="breadcrumb-item" id="katMenu">`+ M + `</li>
            <li class="breadcrumb-item active" id="Dbuku" aria-current="page">`+ P + `</li>
        `);
    } else {
        $('.breadcrumb').append(`
            <li class="breadcrumb-item active" id="katMenu" aria-current="page">`+ M + `</li>
        `);
    }
}

// Beres
function updateURL(url, data) {
    history.pushState(data, 'TitelBar', url);
}

// Beres
var intervalLoad;
function loading(progress, page) {
    var template;
    clearInterval(intervalLoad);
    loadingProgress.style.width = progress + '%';
    if (progress !== 0) {
        // remove display none
        loadingBar.style.display = '';
    }
    if (progress === 100) {
        setTimeout(() => {
            loadingBar.style.display = 'none';
            loadingProgress.style.width = '0%';
        }, 500);
        return true;
    }

    intervalLoad = setInterval(() => {
        if (progress >= 95) {
            clearInterval(intervalLoad);
        }
        progress += 5;
        loadingProgress.style.width = progress + '%';
    }, 2_000);

    return false;
    if (page === 'detail') {
        template = skeleteonPageDetail.content.cloneNode(true);
        containerBookList.innerHTML = ''
    } else if (page === 'all-book') {
        template = skeleteonPageAllBook.content.cloneNode(true);
    } else if (page === 'stack-book') {
        template = skeleteonPageStackBook.content.cloneNode(true);
        containerBookList.innerHTML = ''
    } else {
        template = 'Pilihan Gak ada';
    }
    containerBookList.innerHTML = ''
    containerBookList.append(template)
}


function runSearch(keyword) {
    window.scrollTo(0, 0);
    const keyUrl = keyword.replace(/ /g, "+");
    loading();
    updateURL(bUrl + '/Semua-Buku?search=' + keyUrl, 'searchPage', 'search=' + keyUrl, keyUrl);
    $('#mySidenav').removeClass('show');
    $('#menuBook .nav-link').removeClass('activeMenu');
    $('[spacialatt]').addClass('activeMenu');
    $('#buku').html('');
    searchBook(keyword, 0);
    $('#search-Book').val('').blur();
    setTimeout(function () {
        updateBreadcrumb('Semua Buku', 'Cari buku', tmpData);
    }, 1000);
}

// ==================================>  Navigation
let kMenu;

// klik buku lainya pada page semua buku
$('#buku').on('click', '#moreBook', function () {
    $('#menuBook .nav-link').removeClass('activeMenu');
    $('#buku').html('');
    loading();
    const menu = $('[key=' + $(this).attr('goTo').replace(/ /g, "") + ']'); //cari btnnya submenu di sidebar
    menu.addClass('activeMenu');
    kMenu = $('#k' + menu.attr('id')).html(); // ambil path submenu
    $('#menuBook').attr('act', menu.attr('unicCode')); //update attr act di sidebar
    updateBreadcrumb(kMenu, menu.text());
    var u = menu.text().replace(/ /g, "-");
    updateURL(bUrl + '/' + u, u, menu.attr('key'));
    inCategory($(this).attr('goTo'));
});

$('#search-Book').on('keyup', function (e) {
    if (e.keyCode === 13) {
        if ($('#search-Book').val() != '') {
            const key = $('#search-Book').val();
            runSearch(key);
        }
    }
});
$('#btnSearch').on('click', function () {
    if ($('#search-Book').val() != '') {
        const key = $('#search-Book').val();
        runSearch(key);
    }
});
$('#buku').on('click', '#saveBook', function () {
    const id = $('#saveBook').attr('data-id');
    addBookmark(id);
})

// on click menu
sidebarNavLink.on('click', function (e) {
    e.preventDefault();
    const stackSlug = $(this).attr('data-stack-slug');
    // handle active menu
    sidebarNavLink.removeClass('active');
    $(this).addClass('active');
    // move Page
    movePageStack(stackSlug)
    updateURL(`${bashurl}/${stackSlug}`, {
        page: 'list',
        stack: stackSlug,
        search: false
    });
    return true;
});

// klik lihat buku
$(containerBookList).on('click', 'a.buku_title, .img-cover-book', function (e) {
    e.preventDefault()
    const slugBook = $(this).attr('data-book-slug');
    const slugStack = $(this).attr('data-stack-slug');
    // handle active menu
    // sidebarNavLink.removeClass('active');
    // $(this).addClass('active');
    // move Page
    movePageDetail(slugBook, slugStack)
    return true;
});

window.onpopstate = function (event) {
    const data = event.state;

    sidebarNavLink.removeClass('active');
    $('#buku').html('');
    // loading();
    if (data.page === 'detail') {
        return false;
        detailBuku(history.state.book);
        console.log(tmpData);
        updateBreadcrumb(tmpData.pathBook.arr[1], tmpData.pathBook.arr[2], 'detail');
    }
    else if (data.page == 'list') {
        movePageStack(data.stack)
        $(`[data-stack-slug=${data.stack}]`).addClass('active')
        return false
    }
};


function cardBookListHorizonScrol() {
    return strtoHTML(/*html*/`
    <div class="bg-white px-3 pt-3 pb-1 rounded-3 shadow-sm border">
        <div class="conten-scroll rounded-3 scrollBar">
        </div>
    </div>`);
}

function cardBook(title, cover, writer) {
    return strtoHTML(/*html*/`
    <div class="card mx-auto d-inline-block overflow-hidden me-2">
        <img src="${cover ?? 'https://via.placeholder.com/175x250'}" width="175px" alt="cover_book" class="img-fluid">
        <div class="px-1 py-2">
        <a href="#" class="text-dark my-0 py-0 buku_title text-decoration-none" title="Buku" data-book-slug="buku"
            data-stack-slug="buku">${title}</a>
        <p class="d-block my-0 authorBook">
            <small class="text-muted">${writer}</small>
        </p>
        </div>
    </div>`);
}


function cardBookMini(title, genre) {
    return strtoHTML(/*html*/`
    <div class="col-12 mb-2">
        <div class="d-flex">
        <img src="https://via.placeholder.com/80x110" width="90" class="img-fluid rounded flex-shrink-0" alt="cover book">
        <div class="flex-grow-1 ms-2 d-flex flex-column" style="font-weight: 300">
            <a href="#" class="text-decoration-none text-dark text-hover-danger" style="line-height: 17px;">${title}</a>
            <small class="text-muted" style="font-size: 13px">${genre}</small>
        </div>
        </div>
    </div>`)
}


function strtoHTML(strHTML) {
    const div = document.createElement('div');
    div.innerHTML = strHTML.trim();
    return div.firstChild;
}

function uiDetailBook({ title, cover, genre, description }) {
    return strtoHTML(/*html*/`
        <div class="row mb-5">
            <div class="col-12 col-md-8 mb-3">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row">
                    <img src="${cover}" width="220" height="300" class="img-fluid rounded mx-auto" alt="cover book">
                    <div class="ms-3 flex-grow-1 mt-2 mt-md-0">
                        <div class="d-flex flex-column">
                        <h3 style="font-weight: 300" class="mb-0">${title}</h3>
                        <small class="text-muted">${genre}</small>
                        </div>
    
                        <div class="row mt-3">
                        <div class="col mb-3">
                            <button class="btn btn-primary w-100">Baca</button>
                        </div>
                        <div class="col">
                            <div class="btn-group border w-100" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" class="btn btn-light">Simpan</button>
                            <div class="btn-group" role="group">
                                <button id="drop-option" type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="drop-option">
                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
    
                    <div class="mt-3">
                    <h5 style="font-weight: 300" class="border-bottom">Deskripsi:</h5>
                    <p style="font-size: 14px">${description}</p>
                    </div>
    
                    <div class="mt-3">
                    <h5 style="font-weight: 300" class="border-bottom">Detail buku:</h5>
                    <div class="row">
                        <div class="col-6">
                        <ul class="list-unstyled">
                            <li>Judul: 
                            <span style="font-weight: 300; font-size: 15px">${title}</span>
                            </li>
                            <li>Penulis: 
                            <span style="font-weight: 300; font-size: 15px">${penulis}</span>
                            </li>
                            <li>Penerbit: 
                            <span style="font-weight: 300; font-size: 15px">${penerbit}</span>
                            </li>
                        </ul>
                        </div>
                        <div class="col-6">
                        <ul class="list-unstyled">
                            <li>Genre: 
                            <span style="font-weight: 300; font-size: 15px">${genre}</span>
                            </li>
                            <li>Dibaca: 
                            <span style="font-weight: 300; font-size: 15px">${read}</span>
                            </li>
                            <li>Di upload: 
                            <span style="font-weight: 300; font-size: 15px">${uploaded}</span>
                            </li>
                        </ul>
                        </div>
                    </div>
                    </div>
                </div>      
                </div>
            </div>
            <div class="col-12 col-md-4 pe-lg-4">
                <div class="card p-2">
                    <div class="row flex-column more-book-list">
                    </div>
                </div>
            </div>
        </div>`)
}