MOVIERATING — Web Review & Đánh Giá Phim

Dự án “Web Review & Đánh Giá Phim” là một nền tảng trực tuyến cho phép người dùng tra cứu, xem thông tin chi tiết về các bộ phim và tham gia đóng góp ý kiến, đánh giá chất lượng phim. Hệ thống hướng tới việc xây dựng một cộng đồng người xem phim năng động, minh bạch và có tính tương tác cao, nơi mỗi người có thể chia sẻ nhận xét và đánh giá cá nhân để giúp người khác lựa chọn phim phù hợp.
//Giao Diện Chính//

Nhóm 10:
 - Nguyễn Văn Trường	23010371 (Backend)
 - Trịnh Đình Thuận	23010340 (Frontend)
 - Đỗ Trung Kiên	23010516(Database/Tester)

Nền tảng cho phép người dùng:
- Xem thông tin phim (tên, mô tả, thể loại, trailer, điểm đánh giá, v.v.)
- Viết review, chấm rating (1–5 sao)
- Xem đánh giá trung bình, bình luận từ cộng đồng
- Quản trị viên (admin) có thể thêm, sửa, xóa phim và quản lý người dùng

Bản báo cáo: (https://docs.google.com/document/d/1GeZrst5h7bVbBITEmwdeUxH7h8hq8z2f/edit)

usecase
<img width="957" height="756" alt="image" src="https://github.com/user-attachments/assets/4f92cd82-2e11-43f7-8f89-ade4f9eaec8d" />

<h1 align='center'>How to deploy - Local Development</h1>

Install larvel:
    
    composer create-project --prefer-dist laravel/laravel {name}
    php artisan serve

Clone the Repository:

    git clone [https://github.com/m](https://github.com/truong180805/CSE702051-1-1-25-COUR01.TH4-.git)
    
Install Dependencies:

    composer install
    npm install
    
If not installed nodejs:

    curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash - && sudo apt-get install -y nodejs

Install Dependencies orthers:

    npm run build
    npm run dev
    
Set Up Environment Variables:

    cp .env.example .env
    php artisan key:generate
    
Configure Database Settings:

Edit the .env file to match your local database settings.

Run Migrations and Seed the Database:


    php artisan migrate --seed
    
Start the Local Development Server:

    php artisan serve --host=0.0.0.0
    
Visit the Application:

Open your browser and navigate to http://localhost:8000
