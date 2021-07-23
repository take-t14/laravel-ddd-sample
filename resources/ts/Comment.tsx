import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import {
  List,
  ListItem,
  Divider,
  ListItemText,
  ListItemAvatar,
  Avatar,
  Typography
} from "@material-ui/core";
import Faker from "faker";
import Rating from '@material-ui/lab/Rating';

const useStyles = makeStyles(theme => ({
  root: {
    width: "100%",
    backgroundColor: theme.palette.background.paper
  },
  fonts: {
    fontWeight: "bold"
  },
  inline: {
    display: "inline"
  },
}));

const Comment = ({ comments }:any) => {
  const classes = useStyles();
  return (
    <List className={classes.root}>
      {comments.map((comment:any) => {
        console.log("Comment", comment);
        return (
          <React.Fragment key={comment.reviewId.value}>
            <ListItem key={comment.reviewId.value} alignItems="flex-start">
              <ListItemAvatar>
                <Avatar alt="avatar" src={Faker.image.avatar()} />
              </ListItemAvatar>
              <ListItemText
                primary={
                  <>
                    <Typography className={classes.fonts}>
                      {comment.initial.value}
                    </Typography>
                    <Typography>
                      <Rating name="read-only" value={comment.reviewPoint.value} readOnly />
                    </Typography>
                  </>
                  }
                secondary={
                  <>
                    <Typography
                      component="span"
                      variant="body2"
                      className={classes.inline}
                      color="textPrimary"
                    >
                      {comment.insDate.value}
                    </Typography>
                    {` - ${comment.comment.value}`}
                  </>
                }
              />
            </ListItem>
            <Divider />
          </React.Fragment>
        );
      })}
    </List>
  );
};

export default Comment;
