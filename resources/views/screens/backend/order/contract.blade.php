<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>HỢP ĐỒNG TẬP GYM CÓ HUẤN LUYỆN VIÊN</title>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
            border: 2px solid #999999;
            padding: 31px;
        }
    </style>
</head>

<body>
    <div style="overflow-x: auto;">
        <b style="text-align: left;">Gym T&T Center</b>
        <h4 style="text-align:center">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h4>
        <h4 style="text-align:center">Độc lập - Tự do - Hạnh Phúc</h4>
        <p style="text-align:right">
            Hà Nội, Ngày {{date('d')}} tháng {{date('m')}} năm {{date('Y')}}
        </p>
        <h3 style="text-align: center;">HỢP ĐỒNG HUẤN LUYỆN</h3>
        <p style="text-align: center;">Hợp đồng số : {{$order->id}}...</p>
        <b>Thông tin cá nhân</b>
        @foreach($order->users as $user)
        <p>Họ và tên : {{$user->name}}</p>
        {{-- <p>Giới tính : {{gender()[$user->gender]}}</p> --}}
        <p>Điện thoại di động : +84 {{$user->phone}}</p>
        <p>Email : {{$user->email}}</p>
        <p>Địa chỉ liên hệ : {{$user->address}}</p>
        @endforeach
        <b>Loại gói tập</b>
        <p>Số buổi tập có huấn luyện viên : {{$order->package->total_session_pt}} buổi</p>
        <p>Giá gói tập : {{number_format($order->package->into_price,0,'.','.')}}vnđ</p>
        <p>Gói tập : {{$order->package->package_name}}</p>
        <p>Có hiệu lực kể từ ngày : {{date('d/m/Y', strtotime($order->date_start))}}</p>
        <b>Quyền hạn và nghĩa vụ của khách hàng</b>
        <p>Thực hiện đầy đủ những điều kiện cần thiết đã cam kết trong Hợp đồng lao động để người lao động đạt hiệu quả công việc cao. Bảo đảm việc làm cho người lao động theo Hợp đồng đã ký.</p>
        <p>Thanh toán đầy đủ, đúng thời hạn các chế độ và quyền lợi cho người lao động theo Hợp đồng lao động.</p>
        <p>Tạm hoãn, chấm dứt Hợp đồng, kỷ luật người lao động theo đúng quy định của Pháp luật, và nội quy lao động của Công ty.</p>
        <p>Có quyền đòi bồi thường, khiếu nại với cơ quan liên đới để bảo vệ quyền lợi của mình nếu người lao động vi phạm Pháp luật hay các điều khoản của hợp đồng này.</p>
        <b>Quyền hạn và nghĩa vụ của huấn luyện viên</b>
        <p>Làm việc với tinh thần luôn đặt kết quả của khách hàng và hình ảnh của công ty lên hàng đầu.</p>
        <p>Hoàn thành công việc được giao và sẵn sàng chấp nhận mọi sự điều động khi có yêu cầu.</p>
        <p>Bồi thường thiệt hại theo nội quy của công ty và quy định của pháp luật.</p>
        <div style="margin-top: 12px;">
            <span>
                <b style="padding-left: 31px;">HUẤN LUYỆN VIÊN</b>
            </span>
            <span>
                <b style="padding-left: 312px;">KHÁCH HÀNG</b>
            </span><br>
            <span>
                <span style="padding-left: 28px;">( Ký và ghi rõ họ tên )</span>
            </span>
            <span>
                <span style="padding-left: 286px;">( Ký và ghi rõ họ tên )</span>
            </span>
        </div>
    </div>
</body>

</html>