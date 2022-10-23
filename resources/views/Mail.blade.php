<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>From Acme Pet Clinic</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background-color:#e6ffff">

<h3>Consultation Details</h3>
<p><i class="fa fa-id-badge" aria-hidden="true"></i> Employee ID:  {{ $info['employee_id'] }}</p>
<p><i class="fa fa-paw" aria-hidden="true"></i> Pet ID: {{ $info['pet_id'] }}</p>
<p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Pet Status: {{ $info['pet_status'] }}.</p>
<p><i class="fa fa-calendar-o" aria-hidden="true"></i> Check up Date: {{ $info['checkup_date'] }}.</p> 
<p><i class="fa fa-info" aria-hidden="true"></i> Disease Id: {{ $info['disease_id'] }}</p>
<p><i class="fa fa-comments" aria-hidden="true">Coments: {{ $info['comments'] }}.</p>
<p><i class="fa fa-usd" aria-hidden="true"></i>Check up Cost {{ $info['checkup_cost'] }}.</p>
<p><i class="fa fa-exclamation" aria-hidden="true"></i>This is a Detailed Information Provided by Acme Pet Clinic</p>
<a href="{{url('/')}}">{{url('/')}}</a>

</body>
</html>