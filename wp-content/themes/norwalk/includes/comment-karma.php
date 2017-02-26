/*

	Need to track for each vote:
		ID of post comment is attached to
		ID of comment voted on
		ID of user who voted
		IP of user
		Time of vote
		Time of vote (GMT)
		Type of vote


	Each comment needs its current vote score contained in DB field so we don't need to do extensive querying and calculation at render time

	Make it easier for Mom to update NoN's facebook.
*/
