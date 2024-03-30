function writeComments(data) {
    //console.log(data);
    var besDece = data['comments'].filter(el => el.get_parent);
    var saDecom = data['comments'].filter(el => el.get_children.length >=1 || el.parent_id === null);
    let html = "";
    for (let el of saDecom) {

        html += `<div class="reviews-members ">
                    <input type="hidden" name="comment-id" id="comment-${el.id}"  class="commentid" value="${el.id}">
                        <div class="media">
                            <a href="${xxxRoute.replace(':xxx',el.get_user.id)}"><img class="mr-3" src="${baseUrl + '/assets/img/' + el.get_user.avatar}" alt="Generic placeholder image"></a>
                            <div class="media-body">
                                <div class="reviews-members-header">
                                <h6 class="mb-1">
                                    <a class="text-white" href="${xxxRoute.replace(':xxx',el.get_user.id)}">${el.get_user.username} </a>
                                    <small class="text-gray">${el.created_at ? el.created_at.substring(0, 10) : ""}</small>
                                </h6>
                                </div>
                                    <div class="reviews-members-body">
                                        <p> ${el.text}</p>
                                    </div>
                                        <div class="reviews-members-footer">
                                            <a id="likes-count-${el.id}" class="mr-1 total-like likeMoj  ${vratiLajk(el) === 'liked' ? 'liked' : ''}" href="#">
                                                <i class="fas fa-thumbs-up "></i> ${el.get_total_likes.length}
                                            </a>
                                            <a id="dislikes-count-${el.id}" class="total-like dislikeMoj ${vratiLajk(el) === 'disliked' ? 'disliked' : ''}" href="#">
                                                <i class="fas fa-thumbs-down "></i> ${el.get_total_dislikes.length}
                                            </a>
                                            <span class="total-like-user-main ml-2">
                                                <span dir="rtl" class="total-like-user-main ml-1 align-bottom comment-reply-btn">
                                                    <a href=""><i id="dugme1" class="fas fa-reply fa-xs "></i>
                                                    <span class=""> Reply </span>
                                                    </a>
                                            </span>
                                                    ${deleteComment(el,$("#userId"))}

                                        </div>


                                        <span class="total-like-user-main comment-replies">
                                              <a href=""><i class="fas fa-xs pt-4 fa-caret-down dugme"></i>
                                                    <span> ${el.get_children.length} Replies..</span>
                                              </a>
                                        </span>
                                                    ${writeChlidren(data['comments'], el.id)}
                                                    <input type="hidden" name="parentid" class="parentcc" value="${el.id}">
                                        </div>
                                    </div>
                                </div>`;
    }

        function vratiLajk( element){
            for (let reaction of element.get_reaction) {
                if (reaction.pivot['comment_id'] === element.id) {
                    if (reaction.pivot['reaction_id'] === 1) {
                        return 'liked';
                    } else if (reaction.pivot['reaction_id'] === 2) {
                        return 'disliked';
                    }
                }
            }
        }



        function writeChlidren(data, element){
            let childrenHTML = "";
            for (let el1 of data){
                if (el1.parent_id === element) {
                    childrenHTML += `<div class="reviews-members hidden">
                                            <input type="hidden" name="comment-id" id="comment-${el1.id}" class="commentid" value="${el1.id}">
                                            <div class="media">
                                                <a href="${xxxRoute.replace(':xxx',el1.get_user.id)}">
                                                    <img class="mr-3" src="${baseUrl + '/assets/img/' + el1.get_user.avatar}" alt="Generic placeholder image">
                                                </a>
                                               <div class="media-body">
                                                    <div class="reviews-members-header">
                                                        <h6 class="mb-1">
                                                        <a class="text-white" href="${xxxRoute.replace(':xxx',el1.get_user.id)}">${el1.get_user.username}
                                                        </a>
                                                            <small class="text-gray">${el1.created_at ? el1.created_at.substring(0, 10) : ""}</small>
                                                        </h6>
                                                    </div>
                                                    <div class="reviews-members-body">
                                                        <p>${el1.text}</p>
                                                    </div>
                                                    <div class="reviews-members-footer">
                                                        <a id="likes-count-${el1.id}"  class="mr-1 total-like likeMoj ${vratiLajk(el1) === 'liked' ? 'liked' : ''}" href="#">
                                                        <i class="fas fa-thumbs-up"></i>
                                                            ${el1.get_total_likes.length}
                                                        </a>
                                                        <a id="dislikes-count-${el1.id}" class="total-like dislikeMoj ${vratiLajk(el1) === 'disliked' ? 'disliked' : ''}" href="#">
                                                            <i class="fas fa-thumbs-down"></i>
                                                            ${el1.get_total_dislikes.length}
                                                        </a>
                                                            ${deleteComment(el1,$("#userId"))}


                                                    </div>
                                               </div>
                                            </div>
                                        </div>`
                }
            }
            return childrenHTML;
        }
        document.getElementById('commentsMoje').innerHTML = html
    }

window.onload = function (){

    fetch('/comments/'+ $('#videoid').val()).then(response=> response.json()).then(
        json=>{
            writeComments(json);
        }
    )

}
