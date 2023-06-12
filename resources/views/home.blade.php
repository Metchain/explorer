@include('layout.header')
<div class="inner-body">
	@include('module.search')

	<div class="full-box">
		<div class="part-3">
			<div class="b-r-3">
				<div class="home-headers">
					<div class="met-icon"></div>
					<div>
						<h4>Met Price <span>+ 0.00 %</span></h4>
						<h5>$ 0.00 <span>0.000000000 BTC<span></h5>
					</div>
				</div>
				<div class="home-headers">
					<div class="met-icon mm-icon"></div>
					<div>
						<h4>MARKET CAP</h4>
						<h5>$ 0.00</h5>
					</div>
				</div>		
			</div>
			
		</div>
	
		<div class="part-3">
			<div class="b-r-3">
				<div class="home-headers">
					<div class="met-icon tx-icon"></div>
					<div>
						<h4>TRANSACTIONS</h4>
						<h5>0.0<span>0 TPS<span></h5>
					</div>
				</div>
				<div class="home-headers">
					<div class="met-icon fuel-icon"></div>
					<div>
						<h4>AVG FUEL PRICE</h4>
						<h5>0.00 mMET<span>($.00)<span></h5>
					</div>
				</div>		
			</div>
			
		</div>
	</div>
	<div class="full-box w-50p list-header">
		<h4>Latest Transaction</h4>
		<h5>The Most latest transaction published</h5>
		@foreach($transactions as $transaction)
		<div class="listing-tx">
			
			<div class="ltx-icon">TX</div>
			<div class="dual-split">
				<div><a href="{{route('tx',$transaction->txHash)}}">{{$transaction->txHash}}</a></div>
				<div class="time-ago">
					<abbr class="timeago testLongTerm" title="{{date('Y-m-d\TH:i:s\Z',($transaction->timestamp/1000000000))}}">{{date('Y-m-d\TH:i:s\Z',($transaction->timestamp/1000000000))}}</abbr>
				</div>
			</div>
			<div class="dual-split">
				<div><span>From</span>  <a href="">{{$transaction->from}}</a></div>
				<div><span>To</span>  <a href="">{{$transaction->to}}</a></div>
			</div>
			<div class="tx-amount">{{$transaction->amount}} Met</div>
			
		</div>
		@endforeach
	</div>
	<div class="full-box w-50p list-header">
		<h4>Latest Block</h4>
		<h5>The Most block mined</h5>
		@foreach($blocks as $block)
		<div class="listing-tx">
			
			<div class="ltx-icon">BK</div>
			<div class="dual-split">
				<div><a href="">{{$block->block_height}}</a></div>
				<div class="time-ago">
					<abbr class="timeago testLongTerm" title="{{date('Y-m-d\TH:i:s\Z',($block->timestamp/1000000000))}}">{{date('Y-m-d\TH:i:s\Z',($block->timestamp/1000000000))}}</abbr>
				</div>
			</div>
			<div class="dual-split" style="width:50%">
				<div><span>Miner</span>  <a href="">Metchain NFT Pool </a></div>
				<div><span class="special-color">2 Txns</span><span>in 10 secs</span></div>
			</div>
			
		</div>
		@endforeach
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".timeago").timeago();
	});
</script>

@include('layout.footer')