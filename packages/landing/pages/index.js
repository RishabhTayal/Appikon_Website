import { ResetCSS } from 'common/src/assets/css/style';
import AboutUsSection from 'common/src/containers/Agency/AboutUsSection';
import {
  AgencyWrapper,
  GlobalStyle
} from 'common/src/containers/Agency/agency.style';
import BannerSection from 'common/src/containers/Agency/BannerSection';
import BlogSection from 'common/src/containers/Agency/BlogSection';
import FaqSection from 'common/src/containers/Agency/FaqSection';
import FeatureSection from 'common/src/containers/Agency/FeatureSection';
import Footer from 'common/src/containers/Agency/Footer';
import Navbar from 'common/src/containers/Agency/Navbar';
import NewsletterSection from 'common/src/containers/Agency/NewsletterSection';
import QualitySection from 'common/src/containers/Agency/QualitySection';
import TeamSection from 'common/src/containers/Agency/TeamSection';
import TestimonialSection from 'common/src/containers/Agency/TestimonialSection';
import VideoSection from 'common/src/containers/Agency/VideoSection';
import WorkHistory from 'common/src/containers/Agency/WorkHistory';
import { DrawerProvider } from 'common/src/contexts/DrawerContext';
import { agencyTheme } from 'common/src/theme/agency';
import Head from 'next/head';
import React, { Fragment } from 'react';
import Sticky from 'react-stickynode';
import { ThemeProvider } from 'styled-components';

export default () => {
  return (
    <ThemeProvider theme={agencyTheme}>
      <Fragment>
        {/* Start agency head section */}
        <Head>
          <title>Appikon | Shopify apps to grow your business</title>
          <meta name="theme-color" content="#10ac84" />
          <meta name="Description" content="React next landing page" />
          {/* Load google fonts */}
          <link
            href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
            rel="stylesheet"
          />
        </Head>
        <ResetCSS />
        <GlobalStyle />
        {/* End of agency head section */}
        {/* Start agency wrapper section */}
        <AgencyWrapper>
          <Sticky top={0} innerZ={9999} activeClass="sticky-nav-active">
            <DrawerProvider>
              <Navbar />
            </DrawerProvider>
          </Sticky>
          <BannerSection />
          <FeatureSection />
          <AboutUsSection />
          <WorkHistory />
          <BlogSection />
          <QualitySection />
          <VideoSection />
          <TestimonialSection />
          <TeamSection />
          <FaqSection />
          <NewsletterSection />
          <Footer />
        </AgencyWrapper>
        {/* End of agency wrapper section */}
      </Fragment>
    </ThemeProvider>
  );
};
