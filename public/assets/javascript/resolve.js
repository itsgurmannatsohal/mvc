let book_id, book_status;
const button1 = document.querySelectorAll(".accept-btn");
const button2 = document.querySelectorAll(".deny-btn");

function acceptId(elem1, elem2, elem3, elem4) {
  book_id = elem1;
  request_type = elem2;
  enrolment_number = elem3;
  available = elem4;
  console.log(elem1, elem2, elem3, elem4);
  postaccept();
}

function denyId(elem1, elem2, elem3) {
  book_id = elem1;
  request_type = elem2;
  enrolment_number = elem3;
  postdeny();
}

function postaccept() {
  console.log("Accepted");
  axios
    .post("/admin/requests/accept", {
      book_id: book_id,
      request_type: request_type,
      enrolment_number: enrolment_number,
      available: available,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/admin/requests";
    });
}

function postdeny() {
  console.log("Denied");
  axios
    .post("/admin/requests/deny", {
      book_id: book_id,
      request_type: request_type,
      enrolment_number: enrolment_number,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/admin/requests";
    });
}

function plus(elem1, elem2, elem3) {
  book_id = elem1;
  copies = elem2;
  available = elem3;
  postplus();
}

function minus(elem1, elem2, elem3) {
  book_id = elem1;
  copies = elem2;
  available = elem3;
  postminus();
}

function postplus() {
  axios
    .post("/admin/books/plus", {
      book_id: book_id,
      copies: copies,
      available: available,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/admin/books";
    });
}

function postminus() {
  axios
    .post("/admin/books/minus", {
      book_id: book_id,
      copies: copies,
      available: available,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/admin/books";
    });
}

const button3 = document.querySelectorAll(".checkout-btn");
const button4 = document.querySelectorAll(".checkin-btn");

function checkoutId(elem1, elem2) {
  postcheckout(elem1, elem2);
}

function checkinId(elem) {
  console.log(elem);
  postcheckin(elem);
}

function postcheckout(elem1, elem2) {
  axios
    .post("/dashboard/requestOut", {
      book_id: elem1,
      available: elem2,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/dashboard";
    });
}

function postcheckin(elem) {
  axios
    .post("/dashboard/requestIn", {
      book_id: elem,
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