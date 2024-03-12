<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    
  </head>
  <body>
    <div class="container">
      <div class="panel profile-cover">
        <div class="profile-cover__img">
          <img
            src="https://bootdey.com/img/Content/avatar/avatar6.png"
            alt=""
          />
          <h3 class="h3">Nguyễn Tiến Hoàng</h3>
        </div>
        <div class="profile-cover__action bg--img" data-overlay="0.3">
          <button class="btn btn-rounded btn-info">
            <i class="fa fa-plus"></i>
            <span>Follow</span>
          </button>
          <button class="btn btn-rounded btn-info">
            <i class="fa fa-comment"></i>
            <span>Message</span>
          </button>
        </div>
        <div class="bg-light my-6">
          <br style="padding: 30 0 30 0" />
          <br style="padding: 30 0 30 0" />
          <br style="padding: 30 0 30 0" />
          <br style="padding: 30 0 30 0" />
          <br style="padding: 30 0 30 0" />
        </div>
        <div class="profile-cover__info bg-dark">
          <nav class="navbar navbar-expand-sm bg-dark text-white">
            <div class="container-fluid">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a
                    href="./profile.html"
                    class="nav-link text-white text-uppercase text-bold"
                    >Thông tin cá nhân</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    href="./schedule.html"
                    class="nav-link text-white text-uppercase text-bold"
                    >Lịch trinh tập luyện</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    href=""
                    class="nav-link text-white text-uppercase text-bold"
                    >Đổi mật khẩu</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    href="./updateMK.html"
                    class="nav-link text-white text-uppercase text-bold"
                  ></a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-3 py-5">
          <h4 class="text-left">Thay đổi mật khẩu</h4>

          <form action="">
            <div class="form-group mt-3">
              <label for="email">Email :</label>
              <input
                type="email"
                class="form-control"
                placeholder="Enter email"
                id="email"
              />
            </div>
            <div class="form-group mt-3">
              <label for="pwd">Mật khẩu:</label>
              <input
                type="password"
                class="form-control"
                placeholder="Enter password"
                id="pwd"
              />
            </div>
            <div class="form-group mt-3">
              <label for="pwd">Nhập lại mật khẩu:</label>
              <input
                type="password"
                class="form-control"
                placeholder="Enter password"
                id="pwd"
              />
            </div>
            <div class="form-group mt-3 form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" /> Remember me
              </label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
