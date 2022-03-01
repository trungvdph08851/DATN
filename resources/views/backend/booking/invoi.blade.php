<?php
header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Hóa đơn khám (mã:".$booking->booking_code.").doc");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<meta name="generator" content="Aspose.Words for .NET 21.11.0" />
		<title></title>
		<style type="text/css">
			body {
				font-family: 'Times New Roman';
				font-size: 10pt
			}
	
			p {
				margin: 0pt
			}
	
			table {
				margin-top: 0pt;
				margin-bottom: 0pt
			}
	
			.NormalWeb {
				margin-top: 5pt;
				margin-bottom: 5pt;
				line-height: normal;
				font-family: 'Times New Roman';
				font-size: 12pt
			}
	
			span.Emphasis {
				font-style: italic
			}
	
			span.Strong {
				font-weight: bold
			}
	
			.TableGrid {}
		</style>
	</head>
	
	<body>
		<div>
			<table cellspacing="0" cellpadding="0" style="width:268.2%; border-collapse:collapse">
				<tr style="height:32.4pt">
					<td style="width:12.2%; padding:0.75pt; vertical-align:top">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt"><img
								src="{{ asset('invoilogo.jpg')}}" width="169"
								height="135" alt=""
								style="-aw-left-pos:0pt; -aw-rel-hpos:column; -aw-rel-vpos:paragraph; -aw-top-pos:0pt; -aw-wrap-type:inline" />
						</p>
					</td>
					<td style="width:16.86%; padding:0.75pt; vertical-align:middle">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:14pt"><span>Phòng Khám : Nha khoa Đông
								Anh</span></p>
						<p class="NormalWeb" style="margin-top:14pt; margin-bottom:14pt"><span>Địa chỉ : ECOHOME 3, Đông
								Ngạc</span></p>
						<p class="NormalWeb" style="margin-top:14pt; margin-bottom:14pt"><span>Hotline: 0329316963</span>
						</p>
						<p class="NormalWeb" style="margin-top:14pt; margin-bottom:0pt"><span>Website :
								nhakhoadonganh.tk</span></p>
					</td>
					<td style="width:41.68%; padding:0.75pt; vertical-align:top">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt"><span>Mã hóa đơn: #{{$booking->id}}</span></p>
					</td>
					<td style="width:29.26%; padding:0.75pt; vertical-align:top">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt"><span
								style="-aw-import:ignore">&#xa0;</span></p>
					</td>
				</tr>
			</table>
			<br>
			<p class="NormalWeb" style="margin-top:0pt; margin-bottom:14pt"><span class="Strong"
					style="-aw-import:spaces">&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;
				</span><span class="Strong">HOÁ ĐƠN KHÁM BỆNH</span></p>
			<p class="NormalWeb" style="margin-top:14pt; margin-bottom:14pt"><span>Họ tên khách
					hàng: {{$booking->name}}………………ĐT: {{$booking->phone_number}}…………………</span></p>
			<p class="NormalWeb" style="margin-top:14pt; margin-bottom:14pt"><span>Địa
					Chỉ: {{$booking->address}}………………………..…</span></p>
			<table cellspacing="0" cellpadding="0" class="TableGrid"
				style="border:0.75pt solid #000000; -aw-border:0.5pt single; -aw-border-insideh:0.5pt single #000000; -aw-border-insidev:0.5pt single #000000; border-collapse:collapse">
				<tr style="height:24.7pt">
					<td
						style="width:24.95pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span>STT</span>
						</p>
					</td>
					<td
						style="width:187.15pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span>Dịch vụ
								khám</span></p>
					</td>
					<td
						style="width:106.1pt; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-right:0.5pt single">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span>Thời
								gian</span></p>
					</td>
					<td
						style="width:106.1pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span>Đơn
								giá</span></p>
					</td>
				</tr>
				@php
					$sumPrice = 0;
				@endphp
				@foreach ($booking->services as $item)
					@php
						$sumPrice += $item->price;
					@endphp
					<tr style="height:22pt">
						<td
							style="width:24.95pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
							<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span>{{ $loop->iteration }}</span></p>
						</td>
						<td
							style="width:187.15pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border:0.5pt single">
							<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span>{{$item->name}}</span>
							</p>
						</td>
						<td
							style="width:106.1pt; border-style:solid; border-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border:0.5pt single">
							<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span>{{$item->time}} Phút</span>
							</p>
						</td>
						<td
							style="width:106.1pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-bottom:0.5pt single; -aw-border-left:0.5pt single; -aw-border-top:0.5pt single">
							<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span>{{ number_format($item->price) }}vnd</span>
							</p>
						</td>
					</tr>
				@endforeach
				<tr style="height:22.45pt">
					<td colspan="3"
						style="width:339.8pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-right:0.5pt single; -aw-border-top:0.5pt single">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:right"><span>Tổng cộng
								tiền thanh toán</span></p>
					</td>
					<td
						style="width:106.1pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle; -aw-border-left:0.5pt single; -aw-border-top:0.5pt single">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span
								style="-aw-import:ignore">{{ number_format($sumPrice)}}vnd</span></p>
					</td>
				</tr>
			</table>
			<p class="NormalWeb" style="margin-top:14pt; margin-bottom:14pt"><span style="-aw-import:ignore">&#xa0;</span>
			</p>
			<p class="NormalWeb" style="margin-top:14pt; margin-bottom:14pt"><span>Cộng thành tiền (Viết bằng
					chữ):…………………………………………………………</span></p>
			<table cellspacing="0" cellpadding="0" style="width:115.84%; border-collapse:collapse">
				<tr style="height:36.8pt">
					<td style="width:34.98%; padding:0.75pt; vertical-align:middle">
						<p style="text-align:center"><span>&#xa0;</span></p>
					</td>
					<td style="width:65.02%; padding:0.75pt; vertical-align:middle">
						<p style="text-align:center"><span class="Emphasis">….Ngày ……tháng……năm 20….</span></p>
					</td>
				</tr>
				<tr style="height:73.85pt">
					<td style="width:34.98%; padding:0.75pt; vertical-align:middle">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span
								class="Strong">Người mua hàng</span><br /><span>(Ký, ghi rõ họ tên)</span></p>
					</td>
					<td style="width:65.02%; padding:0.75pt; vertical-align:middle">
						<p class="NormalWeb" style="margin-top:0pt; margin-bottom:0pt; text-align:center"><span
								class="Strong">Người bán hàng</span><br /><span>(Ký, ghi rõ họ tên)</span></p>
					</td>
				</tr>
			</table>
			<p><span style="-aw-import:ignore">&#xa0;</span></p>
		</div>
	</body>
	
	</html>