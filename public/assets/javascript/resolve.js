let bookID, bookStatus;
const button1 = document.querySelectorAll(".accept-btn");
const button2 = document.querySelectorAll(".deny-btn");

function acceptId(elem1, elem2, elem3, elem4) {
  bookID = elem1;
  requestType = elem2;
  enrolmentNumber = elem3;
  available = elem4;
  console.log(elem1, elem2, elem3, elem4);
  postaccept();
}

function denyId(elem1, elem2, elem3) {
  bookID = elem1;
  requestType = elem2;
  enrolmentNumber = elem3;
  postdeny();
}

function postaccept() {
  console.log("Accepted");
  axios
    .post("/admin/requests/accept", {
      bookID: bookID,
      requestType: requestType,
      enrolmentNumber: enrolmentNumber,
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
      bookID: bookID,
      requestType: requestType,
      enrolmentNumber: enrolmentNumber,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/admin/requests";
    });
}

function plus(elem1, elem2, elem3) {
  bookID = elem1;
  copies = elem2;
  available = elem3;
  postplus();
}

function minus(elem1, elem2, elem3) {
  bookID = elem1;
  copies = elem2;
  available = elem3;
  postminus();
}

function postplus() {
  axios
    .post("/admin/books/plus", {
      bookID: bookID,
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
      bookID: bookID,
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
      bookID: elem1,
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
      bookID: elem,
    })
    .then((res) => {
      console.log(res);
      window.location.href = "http://localhost:8080/dashboard";
    });
}

