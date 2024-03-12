<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>DANH SÁCH ĐƠN ĐẶT LỊCH</title>
  <style>
    body {
      font-family: DejaVu Sans;
      font-size: 18px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
      text-align: center;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <div style="overflow-x: auto;">
    <div style="text-align: center;color:blue">
      <h2>Danh sách đơn</h2>
    </div>
    <table>
      <thead>
        <tr style="background-color: #7545be;">
          <th>#ID</th>
          <th>Tên hội viên</th>
          <th>Huấn luyện viên</th>
          <th>Ngày bắt đầu</th>
          <th>Tổng tiền</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)


        <tr>
          <td>{{$order->id}}</td>
          <td>
            @foreach($order->users as $user)
            {{$user->name}}
            @endforeach
          </td>
          <td>@if(isset($order->pt->name))
            {{$order->pt->name}}
            @else
            Gói tập không có pt
            @endif
          </td>
          <td>
            {{date('d/m/Y', strtotime($order->date_start))}}
          </td>
          <td>{{number_format($order->total_money,0,'.','.')}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>

</html>