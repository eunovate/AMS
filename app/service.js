app.service('sidebarSvc', function($location){

	this.sidebarList = [];

	this.getSidebarList = function(){
		var self = this;
		var url = $location.url();
		var splitURL = url.split("/");
		var respond = [];
		switch(splitURL[1]){
			case "home":
				respond.push(['Home', 'header']);
				respond.push(['home', 'home']);
				self.sidebarList = respond;
				return respond;
			break;
			case "course-list":
			case "lesson-list":
				respond.push(['Course', 'header']);
				respond.push(['Course List', 'course-list']);
				respond.push(['Lesson List', 'lesson-list']);				
				self.sidebarList = respond;
				return respond;
			break;
			case "student-list":
			case "student":
				respond.push(['Student', 'header']);
				respond.push(['Student List', 'student-list']);		
				self.sidebarList = respond;
				return respond;
			break;
			case "vehicle-list":
			case "vehicle":
				respond.push(['Vehicle', 'header']);
				respond.push(['Vehicle List', 'vehicle-list']);		
				self.sidebarList = respond;
				return respond;
			break;

			case "class-list":
			case "class":
			case "behaviour-list":
				respond.push(['Class', 'header']);
				respond.push(['Class List', 'class-list']);	
				respond.push(['Behaviour List', 'behaviour-list']);		
				self.sidebarList = respond;
				return respond;
			break;

			case "user-list":
			case "user-group-list":
				respond.push(['User Managment', 'header']);
				respond.push(['User List', 'user-list']);	
				respond.push(['User Group List', 'user-group-list']);		
				self.sidebarList = respond;
				return respond;
			break;

			case "schedule-list":
				respond.push(['Schedule', 'header']);
				respond.push(['Schedule List', 'schedule-list']);		
				self.sidebarList = respond;
				return respond;
			break;

			case "notify-list":
				respond.push(['Notification', 'header']);
				respond.push(['Notification List', 'notify-list']);
				self.sidebarList = respond;
				return respond;
			break;

			default:
			break;
		}
	}
});