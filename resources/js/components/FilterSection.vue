<template>
	<div class="col-lg-4" >
		<div class="card tab-card tab-card2">
			<div class="card-header tab-card-header">
				<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
						<a @click="toggleFilters('one')" class="nav-link" :class="$mq === 'desktop' ? 'active' : ''" data-toggle="tab" href="#filter-result" ref="filter">Filter Results</a>
					</li>
					<li class="nav-item">
						<a @click="toggleFilters('two')" class="nav-link" data-toggle="tab" href="#new-search">New Search</a>
					</li>
				</ul>
			</div>
			<div class="tab-content" id="filter-options">
				<div class="tab-pane fade p-3 location" :class="$mq === 'desktop' ? 'show active' : ''" id="filter-result" ref="filterResult">
					<div class="new-used">
						<label>New/Used</label><br>
						<div class="custom-control custom-radio" v-for="(option, index) in products.type" :key="index">
							<input type="radio" class="custom-control-input" :id="'type' + index" name="type" v-model="search_type" :value="option.type">
							<label class="custom-control-label" :for="'type' + index">{{ option.type }}<span class="t-right">{{ option.count }}</span></label>
						</div>
					</div>

					<div class="year">
                        <select v-model="search_make" @change="getModelsByMake($event)">
							<option value="">All Makes</option>
							<option v-for="(option, index) in make" :value="option.make" :key="index">{{ option.make}}</option>
						</select>

						<select v-model="search_model" :disabled="modelDisable()">
							<option value="">All Models</option>
							<option v-for="(option, index) in models" :value="option" :key="index">{{ option }}</option>
						</select>

						<div class="years_custom">
							<select class="min_year" name="min_year" v-model="min_year" :disabled="minYearDisable()">
								<option value="">Min Year</option>
								<option v-for="(option, index) in fromYears" :value="option" :key="index">{{ option }}</option>
							</select>

							<label>To</label>

							<select class="max_year" name="max_year" v-model="max_year" :disabled="maxYearDisable()">
								<option value="">Max Year</option>
								<option v-for="(option, index) in toYears" :value="option" :key="index">{{ option }}</option>
							</select>
						</div>

						<div class="location_custom">
							<label>ZIP</label>
							<input class="tab-text" name="search_zip" v-model="search_zip" type="tel">

							<label>Radius</label>
							<select name="search_distance" v-model="search_distance">
								<option value="20">20 miles</option>
								<option value="30">30 miles</option>
								<option value="40">40 miles</option>
								<option value="50">50 miles</option>
								<option value="75">75 miles</option>
								<option value="100">100 miles</option>
								<option value="150">150 miles</option>
								<option value="200">200 miles</option>
								<option value="250">250 miles</option>
								<option value="500">500 miles</option>
								<option value="">All miles</option>
							</select>
						</div>
						<button class="chk-btn" @click="submitNew">Search</button>
                        <button v-if="$mq === 'mobile'" class="sc-btn" @click="cancelSearch">Cancel</button>
					</div>
					<div class="year">
						<label>Date Listing</label>
						<select @change="submit" name="dateinstock" v-model="search.dateinstock">
							<option v-for="(value, key) in dateinstock" :value="value" :key="key">{{ key }}</option>
						</select>
					</div>
					<div class="year">
						<label>Price</label>
						<select @change="submit" v-model="search.min_price">
							<option value="">Min Price</option>
							<option v-for="(option, index) in prices" :value="price" :key="index">${{ option }}</option>
						</select>

						<select @change="submit" v-model="search.max_price">
							<option value="">Max Price</option>
							<option v-for="(option, index) in prices" :value="price" :key="index">${{ option }}</option>
						</select>
					</div>
					<div class="new-used new-used2 ">
						<label>Mileage</label><br>
						<div class="make-scroll">
							<div class="custom-control custom-radio" v-for="(option, index) in mileage" :key="index">
								<input type="radio" @change="submit" name="miles" v-model="search.miles" :value="'0,' + option" class="custom-control-input" :id="'miles_' + index">
								<label class="custom-control-label" :for="'miles_' + index">{{ option.toLocaleString() }} or less</label>
							</div>
						</div>
					</div>

					<div class="make-txt">
						<label>Deal Rating</label>
						<label class="con" v-for="(option, index) in dealrating" :key="index">
							<span v-if="option.dealrating == 'great deal'" class="deal-box"><i class="fas fa-arrow-up"></i></span>
							<span v-if="option.dealrating == 'good deal'" class="deal-box deal-box1"><i class="fas fa-arrow-up"></i></span>
							<span v-if="option.dealrating == 'fair price'" class="deal-box deal-box2"><i class="fas fa-arrow-right"></i></span>
							{{ option.dealrating }}<span class="t-right">{{ option.count }}</span>

							<input type="checkbox" @change="submit" v-model="search.dealrating" :value="option.dealrating">
							<span class="checkmark"></span>
						</label>
					</div>

					<div class="make-txt make-txt2">
						<label>Features</label>
						<div class="make-scroll">
							<label class="con" v-for="(option, index) in product_options" :key="index">
								{{option.name}}
								<input type="checkbox" @change="submit" v-model="search.features" :value="option.name" name="features">
								<span class="checkmark"></span>
							</label>
						</div>
                    </div>

					<div class="make-txt color-section" v-if="colors">
						<label>Color</label>
						<label class="con"><span class="colr-box"></span>Black<span class="t-right">(447)</span>

							<input type="checkbox" checked="checked">
							<span class="checkmark"></span>
						</label>

						<label class="con"><span class="colr-box colr-box2"></span>Blue<span class="t-right">(447)</span>

							<input type="checkbox" checked="checked">
							<span class="checkmark"></span>
						</label>

						<label class="con"><span class="colr-box colr-box3"></span>Gray<span class="t-right">(447)</span>

							<input type="checkbox" checked="checked">
							<span class="checkmark"></span>
						</label>

						<label class="con"><span class="colr-box colr-box4"></span>Green<span class="t-right">(447)</span>

							<input type="checkbox" checked="checked">
							<span class="checkmark"></span>
						</label>
						<label class="con"><span class="colr-box colr-box5"></span>Orange<span class="t-right">(447)</span>

							<input type="checkbox" checked="checked">
							<span class="checkmark"></span>
						</label>
						<label class="con"><span class="colr-box colr-box6"></span>Red<span class="t-right">(447)</span>

							<input type="checkbox" checked="checked">
							<span class="checkmark"></span>
						</label>

						<label class="con"><span class="colr-box colr-box7"></span>Silver<span class="t-right">(447)</span>

							<input type="checkbox" checked="checked">
							<span class="checkmark"></span>
						</label>

						<label class="con"><span class="colr-box colr-box8"></span>Yellow<span class="t-right">(447)</span>

							<input type="checkbox" checked="checked">
							<span class="checkmark"></span>
						</label>

						<label class="con"><span class="colr-box colr-box9"></span>Other<span class="t-right">(447)</span>

							<input type="checkbox" checked="checked">
							<span class="checkmark"></span>
						</label>
					</div>

					<div class="Collaps-list">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#collapse1">Body Style<i class="fas fa-chevron-down"></i></a>
									</h4>
								</div>
								<div id="collapse1" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="make-scroll">
											<label class="con" v-for="(option, index) in body" :key="index">
                                                {{ option.body }}<span class="t-right">{{ option.count}}</span>
												<input type="checkbox" @change="submit" v-model="search.body" name="body" :value="option.body">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</div>

							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#collapse2">Exterior Color<i class="fas fa-chevron-down"></i></a>
                                    </h4>
								</div>
								<div id="collapse2" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="make-scroll">
											<label class="con" v-for="(option, index) in extcolor" :key="index">
												{{ option.exteriorcolor }}<span class="t-right">{{ option.count }}</span>
												<input type="checkbox" name="extcolor" :value="option.exteriorcolor" v-model="search.exteriorcolor" @change="submit">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</div>
                            </div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#collapse3">Interior Color<i class="fas fa-chevron-down"></i></a>
                                    </h4>
								</div>
								<div id="collapse3" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="make-scroll">
											<label class="con" v-for="(option, index) in intcolor" :key="index">
												{{ option.interiorcolor }}<span class="t-right">{{ option.count }}</span>
												<input type="checkbox" name="intcolor" :value="option.interiorcolor" v-model="search.interiorcolor" @change="submit">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</div>
                            </div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#collapse4">Drivetrain<i class="fas fa-chevron-down"></i></a>
                                    </h4>
								</div>
								<div id="collapse4" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="make-scroll">
											<label class="con" v-for="(option, index) in drivetrain" :key="index">
												{{ option.drivetrain }}<span class="t-right">{{ option.count }}</span>
												<input type="checkbox" name="intcolor" :value="option.drivetrain" v-model="search.drivetrain" @change="submit">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</div>
                            </div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#collapse5">Transmission<i class="fas fa-chevron-down"></i></a>

									</h4>
								</div>
								<div id="collapse5" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="make-scroll">
											<label class="con" v-for="(option, index) in transmission" :key="index">
												{{ option.transmission }}<span class="t-right">{{ option.count }}</span>
												<input type="checkbox" name="transmission" :value="option.transmission" v-model="search.transmission" @change="submit">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</div>
                            </div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#collapse6">Cylinders<i class="fas fa-chevron-down"></i></a>
                            		</h4>
								</div>
								<div id="collapse6" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="make-scroll">
											<label class="con" v-for="(option, index) in engine.cylinder" :key="index">
												{{ option.enginecylinders }}<span class="t-right">{{ option.count }}</span>
												<input type="checkbox" name="enginecylinders" :value="option.enginecylinders" v-model="search.enginecylinders" @change="submit">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</div>
                            </div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" href="#collapse7">Photos<i class="fas fa-chevron-down"></i></a>
                                    </h4>
								</div>
								<div id="collapse7" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="custom-control custom-radio">
											<input type="radio" name="photos" value="yes" v-model="search.photos" @change="submit" class="custom-control-input" id="photos">
											<label class="custom-control-label" for="photos">Only show cars with photos</label>
										</div>
									</div>
								</div>

							</div>


						</div>
					</div>
				</div>
				<div class="tab-pane fade p-3" id="new-search" role="tabpanel" aria-labelledby="two-tab" ref="two">
					<div class="location">

						<select v-model="search_make">
							<option value="">All Makes</option>
							<option v-for="(option, index) in make" :value="option.make" :key="index">{{ option.make }}</option>
						</select>

						<select v-model="search_model" :disabled="modelDisable()">
							<option value="">All Models</option>
							<option v-for="(option, index) in models" :value="option" :key="index">{{ option }}</option>
						</select>

						<div class="years_custom">
							<select class="min_year" name="min_year" v-model="min_year" :disabled="minYearDisable()">
								<option value="">Min Year</option>
								<option v-for="(option, index) in fromYears" :value="option" :key="index">{{ option }}</option>
							</select>

							<label>To</label>

							<select class="max_year" name="max_year" v-model="max_year" :disabled="maxYearDisable()">
								<option value="">Max Year</option>
								<option v-for="(option, index) in toYears" :value="option" :key="index">{{ option }}</option>
							</select>
						</div>

						<div class="location_custom">
							<label>Zip</label>
							<input class="tab-text" name="search_zip" v-model="search_zip" type="text">

							<label>Radius</label>
							<select name="search_distance" v-model="search_distance">
								<option value="20">20 miles</option>
								<option value="30">30 miles</option>
								<option value="40">40 miles</option>
								<option value="50">50 miles</option>
								<option value="75">75 miles</option>
								<option value="100">100 miles</option>
								<option value="150">150 miles</option>
								<option value="200">200 miles</option>
								<option value="250">250 miles</option>
								<option value="500">500 miles</option>
								<option value="">All miles</option>
							</select>
							<!-- <i class="fas fa-chevron-down"></i> -->
						</div>

						<button class="chk-btn" @click="submitNew">Search</button>
                        <button v-if="$mq === 'mobile'" class="sc-btn" @click="cancelSearch">Cancel</button>
					</div>

				</div>
			</div>
		</div>
	</div>
</template>

<style>
select:disabled {
	background-color: darkgray;
}
button.sc-btn {
    display: inline-block;
	border-radius: 4px;
	font-size: 14px;
	margin-bottom: 10px;
	text-decoration: none;
	width: 100%;
	text-align: center;
	padding: 7px 0 !important;
	background: #e0ebf6 !important;
	color: #00a0dd !important;
	font-weight: 500;
	margin-top: 10px;
	border: none;
}

button.chk-btn {
	display: inline-block;
	border-radius: 4px;
	font-size: 14px;
	margin-bottom: 10px;
	text-decoration: none;
	width: 100%;
	text-align: center;
	padding: 7px 0 !important;
	background: #00a0dd !important;
	color: #000 !important;
	font-weight: 500;
	margin-top: 10px;
	border: none;
}
button.chk-btn:hover {
	background: #165a84 !important;
	color: #fff !important;
}
.tab-card-header {
	padding: 0;
}
.card-header-tabs {
	margin: 0;
}
.card.tab-card.tab-card2 a.active {
	padding: 14px 0 !important;
	background: #fff;
	font-size: 13px;
	color:#000;
}
.card.tab-card.tab-card2 a {
	padding: 14px 0 !important;
	font-size: 13px;
}
div#filter-options select {
	width: 100%;
	float: left;
	color: #165a84;
	font-weight: 400;
	line-height: 16px;
	height: 35px;
	position: relative;
	z-index: 9;
	font-size: 14px;
	border: 1px solid #ccc;
	padding-left: 10px;
	border-radius: 4px;
	color:#cccccc !important;
}

.location{
	position:relative;
	margin-top: 30px;
}
input.tab-text {
	width: 100%;
	margin-top: 10px;
	border-radius: 4px;
	border: 1px solid #ccc;
	height: 35px;
}
div#one, div#two {
	padding: 0 0px !important;
}
.new-used {
	margin-top: 30px;
	padding-top: 20px;
	padding-bottom: 20px;
	border-bottom: 1px solid #ebebeb;
}
.new-used label.custom-control-label {
	font-size: 14px;
}

.custom-control.custom-radio {
	margin-bottom: 10px;
}
.year select {
	margin-bottom: 10px;
	color: #333333 !important;
	font-weight:400 !important;
}
.year {
	margin-top: 30px;
	padding-bottom: 20px;
	border-bottom: 1px solid #ebebeb;
	width: 100%;
	display: inline-block;
}
/* checlist */
/* The container */
.con {
	display: block;
	position: relative;
	padding-left: 35px;
	margin-bottom: 12px;
	cursor: pointer;
	font-size: 14px;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

/* Hide the browser's default checkbox */
.con input {
	position: absolute;
	opacity: 0;
	cursor: pointer;
	height: 0;
	width: 0;
}

/* Create a custom checkbox */
.checkmark {
	position: absolute;
	top: 0;
	left: 0;
	height: 20px;
	width: 20px;
	background-color: #eee;
}

.tab-content label {
	text-transform: capitalize;
}

/* On mouse-over, add a grey background color */
.con:hover input ~ .checkmark {
	background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.con input:checked ~ .checkmark {
	background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
	content: "";
	position: absolute;
	display: none;
}

/* Show the checkmark when checked */
.con input:checked ~ .checkmark:after {
	display: block;
}

/* Style the checkmark/indicator */
.con .checkmark::after {

	left: 7px;
	top: 3px;
	width: 5px;
	height: 10px;
	border: solid white;
	border-top-width: medium;
	border-right-width: medium;
	border-bottom-width: medium;
	border-left-width: medium;
	border-width: 0 2px 2px 0;
	-webkit-transform: rotate(45deg);
	-ms-transform: rotate(45deg);
	transform: rotate(45deg);

}
body .card.tab-card.tab-card2 .make-txt a {

	border-bottom: 1px dashed;
	padding-bottom: 4px !important;

}
.card .con input:checked ~ .checkmark {
	background-color: #2196F3;
	border-color: #2196F3;
}
.card .checkmark {
	position: absolute;
	top: 0;
	left: 0;
	height: 20px;
	width: 20px;
	background-color: #fff;
	border: 1px solid #ccc;
	border-radius: 2px;
}
body .custom-control-input:checked ~ .custom-control-label::before {

	color: #fff;
	border-color: #007bff;
	background-color: #fff;

}
.custom-radio .custom-control-input:checked ~ .custom-control-label::after {

	background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23007bff'/%3e%3c/svg%3e");

}
.make-txt {
	margin-top: 30px;
	padding-bottom: 20px;
	border-bottom: 1px solid #ebebeb;
}
span.t-right {
	float: right;
	color:#c9cccc;
	font-size:14px;
	font-weight:400 !important;
}
.make-txt a {
	text-decoration: none;
	color: #165a84 !important;
}
.new-used.new-used2 {
	margin-top: 0;
	border-top: 0;
}
span.deal-box {
	width: 6px !important;
	background: #a9d600;
	text-align: center;
	padding: 3px 6px;
	margin-right: 10px;
	border-radius: 3px;
}
span.deal-box i {
	margin: auto;
	display: inherit;
	color: #fff !important;
	padding: 0 !important;
}
.deal-box1{
	background:#e7c127 !important;
}
.deal-box2{
	background:#bfbfbf !important;
}

span.colr-box {
	padding: 2px 10px;
	background: #000;
	border-radius: 10px;
	margin-right: 7px;
}
.colr-box2{
	background:#4185cc !important;
}
.colr-box3{
	background:#bfbfbf !important;
}

.colr-box4{
	background:#a9d600 !important;
}

.colr-box5{
	background:#e77827 !important;
}
.colr-box6{
	background:#ff0000 !important;
}
.colr-box7{
	background:#e5e5e5 !important;
}
.colr-box8{
	background:#ffd014 !important;
}
.colr-box9{
	background:#fff !important;
}
.Collaps-list {
	margin-top: 20px;
	width: 100%;
	display: inline-block;
}
h4.panel-title a {
	color: #333 !important;
}
.Collaps-list a {
	margin: 0;
	padding: 10px 0 !important;
	border-top: 1px solid #ebebeb;
	width: 100%;
	display: inline-block;
	color: #333 !important;
}
.panel-heading h4 {
	margin: 0;
	position:relative;
}

h4.panel-title i {
	top: 17px !important;
	color: #9999 !important;
}
.panel-body {
	font-size: 14px;
}
.card .tab-content {
	padding: 0px;
}
.card.tab-card.tab-card2 {
	border: none;
}
.card .nav-item .nav-link {
	border: none;
	border-bottom-color: currentcolor;
	border-bottom-style: none;
	border-bottom-width: medium;
	border-bottom:2px solid #ebebeb;
	background: #f8f8f8 !important;
}
#filter-options .location select {

	color: #165a84 !important;
	font-size: 16px;
	font-weight: bold;
	padding: 6px 5px;
	height: 40px;

}

#filter-options #two .location select {
	margin-bottom: 10px;
}
.location .location input {

	height: 40px;
	padding: 0 10px;
	color: #165a84;
	font-weight: bold;

}
.custom-control-label::before{top:3px;}
.custom-control-label::after{top:3px;}
.card .nav-item .nav-link.active {
	background: #fff !important;
	border-color: #41abed;
}
.card .tab-content {
	padding: 0px;
}
.new-used > label {
	font-weight: bold;
	font-size: 14px;
}
.years_custom select {
	width: 40% !important;
}
.years_custom label {
	width: 20%;
	font-size: 16px;
	font-weight: bold;
	text-align: center;
	float: left;
	padding: 15px 0 0;
}
.year label {
	font-weight: bold;
	font-size: 14px;
	margin-bottom: 10px;
}
.location_custom {
	float: left;
}
.location_custom label {
	width: 30%;
	float: left;
	font-size: 16px;
	font-weight: bold;
	margin: 0;
	margin-top: 10px;
}
.location_custom input.tab-text {
	width: 70%;
	margin: 0;
	margin-bottom: 10px;
	padding: 5px;
}
.location_custom select {
	width: 70% !important;
}
.make-txt {
	padding-left: 20px;
	padding-right: 20px;

}
.make-txt.make-txt2 > label{font-weight:bold; margin-bottom:10px; font-size:14px;}
.year{ padding-left:20px; padding-right:20px;}
.custom-control.custom-radio label {
	text-transform: capitalize;
	width: 100%;
	margin: 0 0 8px 0;

}
.make-txt.color-section {
	border-bottom: none;
}
.card.tab-card.tab-card2 .panel-heading h4 a {

	padding: 18px 20px 16px !important;

}
.panel.panel-default .panel-collapse {

	padding: 0 20px 30px;

}
.make-txt.make-txt2 .con{font-weight:normal}
.new-used .custom-control {

	margin: 0;

}
.location {
	padding: 0 20px;
}
.dec {
	font-size: 12px !important;
}
.location .location label {

	font-weight: bold;
	font-size: 14px;
	color: #333;
	margin: 0 0 12px 0;
	width: 100%;

}
.new-used {
	padding: 0px 20px;
}
.make-scroll::-webkit-scrollbar {
	width: 4px;
	background:rgba(0,0,0,0);

}
.make-scroll:hover::-webkit-scrollbar {
	width: 4px;

}
/* Track */
.make-scroll::-webkit-scrollbar-track {
	box-shadow: inset 0 0 4px grey;
	border-radius: 4px;
}

/* Handle */
.make-scroll::-webkit-scrollbar-thumb {
	background: #165a84 ;
	border-radius: 4px;
}

/* Handle on hover */
.make-scroll::-webkit-scrollbar-thumb:hover {
	background: #165a84;
	width:4px;
}
.make-scroll {
	overflow-x: hidden;
	max-height:197px;
	padding-right:5px;
}
@media(max-width: 758px) {
	.card.tab-card.tab-card2 {
		margin-bottom: 20px;
	}
}
</style>

<script>
import _ from 'lodash';

function initialState() {
	return {
		type: 'all',
		zip: '',
		radius: '',
		min_year: '',
		max_year: '',
		make: [],
		min_price: '',
		max_price: '',
		miles: '',
		price: '',
		model: [],
		dealrating: [],
		features: [],
		color: [],
		body: [],
		exteriorcolor: [],
		interiorcolor: [],
		drivetrain: [],
		transmission: [],
		enginecylinders: [],
		photos: '',
		dateinstock: '',
		fuel_type: [],
		doors: [],
		search_make: '',
		search_model: '',
		search_zip: '',
		search_type: '',
		search_body: '',
		search_price: '',
		search_distance: '',
	}
}
export default {
	mounted() {
		this.getQueryParams();
		this.getAllPrices();
		this.getAllYears();
		this.dateListing();
	},
	props: {
		pagination: {
			type: Object
		},
		searchdata: {
			type: Object
		}
	},
	data() {
		return {
			product: {
				data: []
			},
			modelsSet: false,
			products: '',
			current_page: '',
			makes_model: [],
			extcolor: [],
			intcolor: [],
			drivetrain: [],
			body: [],
			price: [],
            fromYears: [],
            toYears: [],
			prices: [],
			mileage: [],
			mileages: [10,20,30,40,50,75,100,150,200,250,500,99999],
			transmission: [],
			transmission_speed: [],
			make: [],
			search_make: '',
			search_model: '',
			search_type: 'all',
			search_price: '',
			search_miles: '',
			search_zip: '',
			search_distance: 50,
			min_year: '',
			max_year: '',
			model: [],
			models: [],
			engine: {
				cylinder: [],
				displacement: []
			},
			passengercapacity: [],
			colors: '',
			dateinstock: [],
			product_options: [],
			fueltype: [],
			dealrating: [],
			type: [
			{text: 'All', value: 'all'},
			{text: 'New', value: 'New'},
			{text: 'Used', value: 'Used'},
			{text: 'Certified Pre-Owned', value: 'certified'},
			],
			search: {
				type: 'all',
				zip: '',
				radius: '',
				min_year: '',
				max_year: '',
				make: [],
				min_price: '',
				max_price: '',
				miles: '',
				price: '',
				model: [],
				dealrating: [],
				features: [],
				color: [],
				body: [],
				dateinstock: '',
				exteriorcolor: [],
				interiorcolor: [],
				drivetrain: [],
				transmission: [],
				enginecylinders: [],
				photos: '',
				fuel_type: [],
				doors: [],
				search_make: '',
				search_model: '',
				search_zip: '',
				search_type: '',
				search_body: '',
				search_price: '',
				search_distance: '',
			},
		}
	},
	methods : {
		submit: function(){
			let searches = this.getStringData(this.search);
			this.axios.get('api/v2/search-products?'+searches).then(response => {
				this.product.data = response.data.product;
				this.products = response.data;
				this.product.data.searches = this.search;
				this.$emit("productData", this.product.data);
				this.make = response.data.make;
				this.model = response.data.model;
				this.dealrating = response.data.dealrating;
				this.body = response.data.body;
				this.product_options = response.data.product_options;
				this.extcolor = response.data.extcolor;
				this.intcolor = response.data.intcolor;
				this.drivetrain = response.data.drivetrain;
				this.transmission = response.data.transmission;
                this.engine.cylinder = response.data.engine.cylinder;
                console.log('adsf', response.data.mileage)
				this.mileage = this.getMileageData(response.data.mileage[0]);
			});
		},
		submitwithPage: function(){
			let searches = this.getStringData(this.search);
			this.axios.get('api/v2/search-products?page='+ this.current_page + '&'+searches).then(response => {
				this.product.data = response.data.product;
				this.products = response.data;
				this.product.data.searches = this.search;
				this.$emit("productData", this.product.data);
				this.make = response.data.make;
				this.model = response.data.model;
				this.dealrating = response.data.dealrating;
				this.body = response.data.body;
				this.product_options = response.data.product_options;
				this.extcolor = response.data.extcolor;
				this.intcolor = response.data.intcolor;
				this.drivetrain = response.data.drivetrain;
				this.transmission = response.data.transmission;
				this.engine.cylinder = response.data.engine.cylinder;
				this.mileage = this.getMileageData(response.data.mileage);
			});
		},
		submitNew() {
			if (this.$mq !== 'mobile') {
				Object.assign(this.$data.search, initialState());
				this.$refs.filter.click();
				this.search.make     = [this.search_make];
				this.search.model = [this.search_model];
				this.search.search_zip = this.search_zip;
				this.search.type = this.search_type;
				this.search.min_year = this.min_year;
				this.search.max_year = this.max_year;
				this.submit();
			} else {
				Object.assign(this.$data.search, initialState());
				this.search.make     = [this.search_make];
				this.search.model = [this.search_model];
				this.search.search_zip = this.search_zip;
				this.search.type = this.search_type;
				this.search.min_year = this.min_year;
				this.search.max_year = this.max_year;
				$("#filterProduct").show();
				$(this.$refs.filterResult).hide();
				$(this.$refs.two).hide();
				this.submit();
			}
        },
        cancelSearch() {
			$(this.$refs.filterResult).hide();
			$(this.$refs.two).hide();
			$("#filterProduct").show();
        },
		getQueryParams() {
			if (this.$route.query) {
				this.getAllModels();
				this.search.type = this.$route.query.type ? this.$route.query.type : 'all';
				this.search.make = [this.$route.query.make ? this.$route.query.make : ''];
				this.search_make = this.$route.query.make ? this.$route.query.make : '';
				this.search.search_distance = this.$route.query.radius ? this.$route.query.radius : '';
				this.search_distance = this.$route.query.radius ? this.$route.query.radius : '';
				this.search.model = [this.$route.query.model ? this.$route.query.model : ''];
				this.search_model = this.$route.query.model ? this.$route.query.model : '';
				this.search.search_zip = this.$route.query.zip ? this.$route.query.zip : '';
				this.search_zip = this.$route.query.zip ? this.$route.query.zip : '';
				this.search.max_price = this.$route.query.price ? this.$route.query.price : '';
				this.search.search_body = this.$route.query.body ? this.$route.query.body : '';
			}
			this.submit();
		},
		getAllPrices() {
			this.axios.get('api/v2/get-all-prices').then(response => {
				this.prices = response.data;
			});
		},
		getAllYears() {
			this.axios.get('api/v2/get-all-years').then(response => {
                yearRange = response.data[0];
                this.fromYears = _.range(yearRange.min, yearRange.max);
                this.toYears = _.range(yearRange.max, yearRange.min, -1);
			});
		},
		getStringData($object) {
			let data = '';
			$.each(this.search, function(key, value) {
				data += key + '=' + value + '&';
			});
			return data;
		},
		getMileageData($object) {
			let data = [];
			let $mileage = 0;
			for (let $i=1; $i <20 ; $i++) {
				$mileage = $mileage + 10000;
				if ($mileage <= $object.max) {
					data.push($mileage);
				}
			}
			return data;
		},
		getCount(value, search) {
			let count = 0;
			for (let $i=0; $i <= this.product.data.data.length ; $i++) {
				$.each(this.product.data.data[$i], function(key, val) {
					if (key == search) {

						if (value ==  val) {
							count++;
						}
					}
				});
			}
			return count;
		},
		getMakeValue(make) {
			if (make == 'bmw') {
				return 'BMW';
			} else {
				return make;
			}
		},
		getModelsByMake(event) {
			this.axios.get('api/v2/get-models-by-make/' + event.target.value).then(response => {
				this.models = response.data;
			});
		},
		getAllModels() {
			this.axios.get('api/v2/get-all-models').then(response => {
				this.models = response.data;
			});
		},
		dateListing() {
			let dates = {};
			for (let i = 1; i <= 30; i++) {
				let currentDate = new Date();
				if (i == 1) {
					currentDate.setDate(currentDate.getDate() - 1);
					dates['Last 1 Day'] = currentDate.toISOString().slice(0,10);
				}
				if (i == 3) {
					currentDate.setDate(currentDate.getDate() - 3);
					dates['Last 3 Days'] = currentDate.toISOString().slice(0,10);
				}
				if (i == 7) {
					currentDate.setDate(currentDate.getDate() - 7);
					dates['Last 7 Days'] = currentDate.toISOString().slice(0,10);
				}
				if (i == 14) {
					currentDate.setDate(currentDate.getDate() - 14);
					dates['Last 2 Weeks'] = currentDate.toISOString().slice(0,10);
				}
				if (i == 30) {
					currentDate.setMonth(currentDate.getMonth() - 1);
					dates['Last 1 Month'] = currentDate.toISOString().slice(0,10);
				}
			}
			dates['All'] = '';
			this.dateinstock = dates;
		},
		toggleFilters(id) {
			if (this.$mq !== 'mobile') {
				if ($("#"+ id +"-tab").hasClass('active')) {
					$("#"+ id +"-tab").removeClass('active');
					$("#"+ id).removeClass('active show');
				}
			} else {
				if ($("#"+ id +"-tab").hasClass('active')) {
					$("#"+ id +"-tab").removeClass('active');
				}
				$(this.$refs[id]).show();
				if (id === 'one') {
					$(this.$refs["two"]).hide();
				} else {
					$(this.$refs["one"]).hide();
				}
				$("#filterProduct").hide();
			}
		},
		modelDisable() {
			if (this.search_make === '') {
				return true;
			}
			return false;
		},
		minYearDisable() {
			if (this.search_make === '' || this.search_model === '') {
				return true;
			}
			return false;
		},
		maxYearDisable() {
			if (this.search_make === '' || this.search_model === '' || this.min_year === '') {
				return true;
			}
			return false;
		},
	},
	watch: {
		pagination() {
			this.current_page = this.pagination.current_page;
			this.submitwithPage();
		},
		searchdata() {
			this.search = this.searchdata;
			this.submit();
		}
	}
};
</script>
