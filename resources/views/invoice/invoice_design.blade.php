@include('layouts.header')
    <h1>Invoice</h1>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $phone }}</td>
        </tr>
        <tr>
            <th>Image</th>
            <td><img src="{{  }}"></td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $address }}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{ $dob }}</td>
        </tr>
    </table>
    <button onclick="window.location.href='{{ route('invoice', ['id' => $id, 'download' => true]) }}'">Download PDF</button>
    
@include('layouts.footer')