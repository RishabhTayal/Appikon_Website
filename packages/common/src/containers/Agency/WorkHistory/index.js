import PropTypes from 'prop-types';
import React from 'react';
import Fade from 'react-reveal/Fade';
import Box from 'reusecore/src/elements/Box';
import Card from 'reusecore/src/elements/Card';
import Heading from 'reusecore/src/elements/Heading';
import Image from 'reusecore/src/elements/Image';
import Text from 'reusecore/src/elements/Text';

import GroupImage2 from '../../../assets/image/agency/group/undraw_revenue_3osh.png';
import ShopifyAppStoreBadge from '../../../assets/image/agency/Shopify-App-Store-Badge-Final-White.png';
import FeatureBlock from '../../../components/FeatureBlock';
import Container from '../../../components/UI/Container';
import WorkHistoryWrapper from './workHistory.style';

const WorkHistory = ({ row, col, cardStyle, title, description, btnStyle }) => {
  return (
    <div>
      <WorkHistoryWrapper id="workHistorySection">
        <Container>
          <Box className="row" {...row}>
            <Box className="col" {...col}>
              {/* <CounterUpArea> */}
              <Card className="card" {...cardStyle}>
                <Fade delay={90}>
                  <Image src={GroupImage2} alt="Feature Image" />
                </Fade>
                {/* <h3>
                    <CountUp start={0} end={20} />+
                  </h3>
                  <Text content="Companies Engaged" /> */}
              </Card>
              {/* <Card className="card" {...cardStyle}>
                  <h3>
                    <CountUp start={0} end={199} duration={5} />
                  </h3>
                  <Text content="Happy Customers" />
                </Card>
                <Card className="card" {...cardStyle}>
                  <h3>
                    <CountUp start={0} end={300} duration={5} />+
                  </h3>
                  <Text content="Project Complete" />
                </Card>
                <Card className="card" {...cardStyle}>
                  <Text content="& Much More" />
                  <Link href="#1">
                    <a>View work history</a>
                  </Link>
                </Card> */}
              {/* </CounterUpArea> */}
            </Box>

            <Box className="col" {...col}>
              <FeatureBlock
                title={
                  <Heading content="Create Mobile App for Store" {...title} />
                }
                description={
                  <Text content="Create native mobile app" {...description} />
                }
                button={
                  // <Button title="WORK HISTORY" {...btnStyle} />
                  <Image
                    src={ShopifyAppStoreBadge}
                    onClick={() => {
                      window.open(
                        'https://apps.shopify.com/ios-android-app-maker-appit', //TODO: change this url
                        '_blank'
                      );
                    }}
                  />
                }
              />
            </Box>
          </Box>
        </Container>
      </WorkHistoryWrapper>

      <WorkHistoryWrapper id="workHistorySection">
        <Container>
          <Box className="row" {...row}>
            <Box className="col" {...col}>
              <FeatureBlock
                title={
                  <Heading content="Out of Stock Notifications" {...title} />
                }
                description={
                  <Text
                    content="Notify your customers when the products are back in stock."
                    {...description}
                  />
                }
                button={
                  // <Button title="WORK HISTORY" {...btnStyle} />
                  <Image
                    src={ShopifyAppStoreBadge}
                    onClick={() => {
                      window.open(
                        'https://apps.shopify.com/ios-android-app-maker-appit', //TODO: change this url
                        '_blank'
                      );
                    }}
                  />
                }
              />
            </Box>
            <Box className="col" {...col}>
              {/* <CounterUpArea> */}
              <Card className="card" {...cardStyle}>
                <Fade delay={90}>
                  <Image src={GroupImage2} alt="Feature Image" />
                </Fade>
                {/* <h3>
                    <CountUp start={0} end={20} />+
                  </h3>
                  <Text content="Companies Engaged" /> */}
              </Card>
              {/* <Card className="card" {...cardStyle}>
                  <h3>
                    <CountUp start={0} end={199} duration={5} />
                  </h3>
                  <Text content="Happy Customers" />
                </Card>
                <Card className="card" {...cardStyle}>
                  <h3>
                    <CountUp start={0} end={300} duration={5} />+
                  </h3>
                  <Text content="Project Complete" />
                </Card>
                <Card className="card" {...cardStyle}>
                  <Text content="& Much More" />
                  <Link href="#1">
                    <a>View work history</a>
                  </Link>
                </Card> */}
              {/* </CounterUpArea> */}
            </Box>
          </Box>
        </Container>
      </WorkHistoryWrapper>

      <WorkHistoryWrapper id="workHistorySection">
        <Container>
          <Box className="row" {...row}>
            <Box className="col" {...col}>
              {/* <CounterUpArea> */}
              <Card className="card" {...cardStyle}>
                <Fade delay={90}>
                  <Image src={GroupImage2} alt="Feature Image" />
                </Fade>
                {/* <h3>
                    <CountUp start={0} end={20} />+
                  </h3>
                  <Text content="Companies Engaged" /> */}
              </Card>
              {/* <Card className="card" {...cardStyle}>
                  <h3>
                    <CountUp start={0} end={199} duration={5} />
                  </h3>
                  <Text content="Happy Customers" />
                </Card>
                <Card className="card" {...cardStyle}>
                  <h3>
                    <CountUp start={0} end={300} duration={5} />+
                  </h3>
                  <Text content="Project Complete" />
                </Card>
                <Card className="card" {...cardStyle}>
                  <Text content="& Much More" />
                  <Link href="#1">
                    <a>View work history</a>
                  </Link>
                </Card> */}
              {/* </CounterUpArea> */}
            </Box>

            <Box className="col" {...col}>
              <FeatureBlock
                title={
                  <Heading content="Custom Pricing (Wholesale)" {...title} />
                }
                description={<Text content="Custom Pricing" {...description} />}
                button={
                  // <Button title="WORK HISTORY" {...btnStyle} />
                  <Image
                    src={ShopifyAppStoreBadge}
                    onClick={() => {
                      window.open(
                        'https://apps.shopify.com/ios-android-app-maker-appit', //TODO: change this url
                        '_blank'
                      );
                    }}
                  />
                }
              />
            </Box>
          </Box>
        </Container>
      </WorkHistoryWrapper>
    </div>
  );
};

// WorkHistory style props
WorkHistory.propTypes = {
  sectionHeader: PropTypes.object,
  sectionTitle: PropTypes.object,
  sectionSubTitle: PropTypes.object,
  row: PropTypes.object,
  col: PropTypes.object,
  cardStyle: PropTypes.object
};

// WorkHistory default style
WorkHistory.defaultProps = {
  // WorkHistory section row default style
  row: {
    flexBox: true,
    flexWrap: 'wrap',
    ml: '-15px',
    mr: '-15px'
  },
  // WorkHistory section col default style
  col: {
    pr: '15px',
    pl: '15px',
    width: [1, 1, 1 / 2, 1 / 2],
    flexBox: true,
    alignSelf: 'center'
  },
  // Card default style
  cardStyle: {
    p: ['20px 20px', '30px 20px', '30px 20px', '53px 40px'],
    borderRadius: '10px',
    boxShadow: '0px 8px 20px 0px rgba(16, 66, 97, 0.07)'
  },
  // WorkHistory section title default style
  title: {
    fontSize: ['26px', '26px', '30px', '40px'],
    lineHeight: '1.5',
    fontWeight: '300',
    color: '#0f2137',
    letterSpacing: '-0.025em',
    mb: '20px'
  },
  // WorkHistory section description default style
  description: {
    fontSize: '16px',
    color: '#343d48cc',
    lineHeight: '1.75',
    mb: '33px'
  },
  // Button default style
  btnStyle: {
    minWidth: '156px',
    fontSize: '14px',
    fontWeight: '500'
  }
};

export default WorkHistory;
