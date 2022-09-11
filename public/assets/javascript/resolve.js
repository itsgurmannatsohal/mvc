let book_id, book_status;
const button1 = document.querySelectorAll(".accept-btn");
const button2 = document.querySelectorAll(".deny-btn");

function acceptId(elem1, elem2, elem3, elem4, elem5) {
  book_id = elem1;
  request_type = elem2;
  username = elem3;
  available = elem4;
  bool = elem5;
  postaccept();
}

function denyId(elem1, elem2, elem3, elem4) {
  book_id = elem1;
  request_type = elem2;
  username = elem3;
  bool = elem4;
  postdeny();
}

function postaccept() {
  console.log("Accepted");
  axios
    .post("/admin/requests/resolve", {
      book_id: book_id,
      request_type: request_type,
      username: username,
      available: available,
      bool : bool,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/admin/requests";
    });
}

function postdeny() {
  console.log("Denied");
  axios
    .post("/admin/requests/resolve", {
      book_id: book_id,
      request_type: request_type,
      username: username,
      bool: bool,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/admin/requests";
    });
}

function plus(elem1, elem2, elem3, elem4) {
  book_id = elem1;
  copies = elem2;
  available = elem3;
  bool = elem4;
  postplus();
}

function minus(elem1, elem2, elem3, elem4) {
  book_id = elem1;
  copies = elem2;
  available = elem3;
  bool = elem4;
  postminus();
}

function postplus() {
  axios
    .post("/admin/books/one", {
      book_id: book_id,
      copies: copies,
      available: available,
      bool : bool,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/admin/books";
    });
}

function postminus() {
  axios
    .post("/admin/books/one", {
      book_id: book_id,
      copies: copies,
      available: available,
      bool: bool,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/admin/books";
    });
}

const button3 = document.querySelectorAll(".checkout-btn");
const button4 = document.querySelectorAll(".checkin-btn");

function checkoutId(elem1, elem2, elem3) {
  postcheckout(elem1, elem2), elem3;
}

function checkinId(elem1, elem2) {
  postcheckin(elem1, elem2);
}

function postcheckout(elem1, elem2, elem3) {
  axios
    .post("/dashboard/request", {
      book_id: elem1,
      available: elem2,
      bool : elem3,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/dashboard";
    });
}

function postcheckin(elem) {
  axios
    .post("/dashboard/request", {
      book_id: elem,
      bool : elem2,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/dashboard";
    });
}

function remove(elem1) {
  postremove(elem1);
}

function postremove(elem1) {
  axios
    .post("/admin/books/remove", {
      book_id: elem1,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/admin/books";
    });
}