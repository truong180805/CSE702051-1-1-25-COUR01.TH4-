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

Bản báo cáo: //file doc//

usecase
csdl

Cài đặt laravel:
composer create-project --prefer-dist laravel/laravel {name}
php artisan serve

Sao chép kho lưu trữ:
git clone https://github.com/truong180805/CSE702051-1-1-25-COUR01.TH4-.git
 

Cài đặt phụ thuộc:
composer install
npm install
Thiết lập biến môi trường:

cp .env.example .env

php artisan key:generate

Cấu hình cài đặt cơ sở dữ liệu:

Chỉnh sửa tệp .env để phù hợp với cài đặt cơ sở dữ liệu cục bộ của bạn.

Chạy Di chuyển và Khởi tạo Cơ sở dữ liệu:

php artisan migrate --seed

Khởi động Máy chủ phát triển cục bộ:

php artisan serve --host=0.0.0.0

Truy cập Ứng dụng:

Mở trình duyệt của bạn và điều hướng đến http://localhost:8000





